<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Response;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        //商品名検索(AND OR)
        if ($request->filled('keyword')) {
            $keyword = mb_convert_kana($request->keyword, 's');
            if (stripos($keyword, ' OR ') !== false) {
                $keywords = preg_split('/\s+OR\s+/i', $keyword);
                $query->where(function ($q) use  ($keywords) {
                    foreach ($keywords as $word) {
                        $q->orWhere('name', 'like', "%{$word}%");
                    }
                });
            }else {
                $keywords = preg_split('/\s+/', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where('name', 'like', "%{$word}%");
                    }
                });
            }
        }

        //カテゴリ絞り込み
        if ($request->filled('category_id')) {
            $query->where('ctg_id', $request->category_id);
        }

        //並び順
        $sortColumn = $request->input('sort_column', 'ctg_id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $allowedSortColumns = ['ctg_id', 'name', 'price'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'ctg_id';
        }
        $query->orderBy($sortColumn, $sortDirection);

        //ページネーション
        $products = $query->paginate(10)->appends($request->all());

        //セレクトボックス用カテゴリリスト
        $categories = Category::with('parent')
            ->whereNotNull('parent_id')
            ->orderBy('sort_order')
            ->get();
            
        foreach ($categories as $cat) {
            $cat->label = optional($cat->parent)->name . ' - ' . $cat->name;
        }

        return view('admin.products.index', compact('products', 'categories', 'sortColumn', 'sortDirection'));
    }

    public function onDelete(Request $request)
    {
        $ids = $request->input('product_ids');
        if ($ids) {
            Product::whereIn('id', $ids)->delete();
        }

        return redirect()->route('admin.products.index')->with('success', '選択した商品を削除しました。');
    }

    public function csv(Request $request)
    {
        $query = Product::query()->with('category');

        // 商品名検索（AND / OR 対応）
        if ($request->filled('keyword')) {
            $keyword = mb_convert_kana($request->keyword, 's');
            if (stripos($keyword, ' OR ') !== false) {
                $keywords = preg_split('/\s+OR\s+/i', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->orWhere('name', 'like', "%{$word}%");
                    }
                });
            } else {
                $keywords = preg_split('/\s+/', $keyword);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where('name', 'like', "%{$word}%");
                    }
                });
            }
        }

        // カテゴリ絞り込み
        if ($request->filled('category_id')) {
            $query->where('ctg_id', $request->category_id);
        }

        // 並び順
        $sortColumn = $request->input('sort_column', 'ctg_id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $allowedSortColumns = ['ctg_id', 'name', 'price'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'ctg_id';
        }
        $query->orderBy($sortColumn, $sortDirection);

        // データ取得
        $products = $query->get();

        // CSVヘッダとデータ作成
        $csvHeader = ['ID', '商品名', '商品説明', '価格', 'カテゴリID', '画像ファイル名'];
        $csvData = [];
        foreach ($products as $product) {
            $csvData[] = [
                $product->id,
                $product->name,
                $product->detail,
                $product->price,
                $product->ctg_id,
                $product->image,
            ];
        }

        // ファイル名
        $filename = 'products_' . now()->format('Ymd_His') . '.csv';

        // ストリームレスポンス
        return Response::stream(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            stream_filter_append($handle, 'convert.iconv.utf-8/cp932'); // 文字化け対策

            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        //バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'price' => 'required|numeric',
            'ctg_id' => 'required|integer|exists:categories,id',
            'main_image' => 'nullable|image|max:2048',
            'sub_images.*' => 'nullable|image|max:2048',
            'delete_sub_images' => 'nullable|array', 
        ]);

        //商品情報更新
        $product->fill([
            'name' => $validated['name'],
            'detail' => $validated['detail'] ?? '',
            'price' => $validated['price'],
            'ctg_id' => $validated['ctg_id'],
        ]);

        //メイン画像保存古いの削除
        if ($request->hasFile('main_image')) {
            if ($product->image) {
                $oldMainPath = public_path('img/products/' . $product->image);
                if (file_exists($oldMainPath)) {
                    unlink($oldMainPath);
                }
            }

            $mainImage = $request->file('main_image');
            $mainFilename = Str::uuid()->toString() . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('img/products'), $mainFilename);
            $product->image = $mainFilename;
        }

        $product->save();

        //サブ画像削除
        if ($request->filled('delete_sub_images')) {
            $deleteIds = $request->input('delete_sub_images');
            $imagesToDelete = ProductImage::whereIn('id', $deleteIds)->get();

            foreach ($imagesToDelete as $img) {
                $path = public_path('img/products/sub/' . $img->image_path);
                if (file_exists($path)) {
                    unlink($path);
                }
                $img->delete();
            }
        }

        //新しいサブ画像保存
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $subFilename = Str::uuid()->toString() . '.' . $subImage->getClientOriginalExtension();
                $subImage->move(public_path('img/products/sub'), $subFilename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $subFilename,
                ]);
            }
        }

        return redirect()->route('admin.products.edit', $product->id)
                         ->with('success', '商品情報を更新しました。');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::with('parent')
            ->whereNotNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        foreach ($categories as $cat) {
            $cat->label = optional($cat->parent)->name . ' - ' . $cat->name;
        }

        $subImages = $product->subImages; // リレーション取得

        return view('admin.products.edit', compact('product', 'categories', 'subImages'));
    }

    public function create()//表示
    {
        //子カテゴリの取得
        $categories = Category::with('parent')
            ->whereNotNull('parent_id')
            ->orderBy('sort_order')
            ->get();
        
        foreach ($categories as $cat) {
            $cat->label = optional($cat->parent)->name . ' - ' . $cat->name;
        }

        return view('admin.products.create', compact('categories'));
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'ctg_id' => 'required|exists:categories,id',
            'main_image' => 'nullable|image|max:2048',
            'sub_images.*' => 'nullable|image|max:2048',
        ]);

        $category = Category::find($validated['ctg_id']);
        $validated['category_label'] = optional($category->parent)->name . ' - ' . $category->name;

        // 一時ファイル保存（main）
        $mainTempPath = null;
        if ($request->hasFile('main_image')) {
            $main = $request->file('main_image');
            $mainTempPath = $main->store('public/temp');
            $validated['main_temp_path'] = $mainTempPath;
            $validated['main_image_name'] = $main->getClientOriginalName();
        }

        // 一時ファイル保存（sub）
        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $img) {
                $path = $img->store('public/temp');
                $subImagePaths[] = ['path' => $path, 'name' => $img->getClientOriginalName()];
            }
        }

        return view('admin.products.confirm', [
            'data' => $validated,
            'sub_images' => $subImagePaths,
        ]);
    }    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'ctg_id' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->detail = $validated['detail'] ?? '';
        $product->price = $validated['price'];
        $product->ctg_id = $validated['ctg_id'];

        // メイン画像（temp→本保存）
        if ($request->filled('main_temp_path')) {
            $tempPath = $request->input('main_temp_path');
            $mainFilename = Str::uuid() . '.' . pathinfo($tempPath, PATHINFO_EXTENSION);
            $targetPath = public_path('img/products/' . $mainFilename);

            Storage::copy($tempPath, $targetPath); // コピー
            Storage::delete($tempPath);            // 削除
            $product->image = $mainFilename;
        }

        $product->save();

        // サブ画像（temp→本保存）
        $paths = $request->input('sub_temp_paths', []);
        $names = $request->input('sub_image_names', []);
        foreach ($paths as $index => $tempPath) {
            $ext = pathinfo($names[$index], PATHINFO_EXTENSION);
            $subFilename = Str::uuid() . '.' . $ext;
            $targetPath = public_path('img/products/sub/' . $subFilename);

            Storage::copy($tempPath, $targetPath);
            Storage::delete($tempPath);

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $subFilename,
            ]);
        }

        return redirect()->route('admin.products.index')
                        ->with('success', '商品を登録しました。');
    }
}
