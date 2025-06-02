<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $test = \App\Models\Category::with('children')->find(1);
        $query = Product::query();

        //キーワード検索
        if ($request->filled('keyword')) {
            //全角スペースを半角に変換してキーワード取得
            $keyword = mb_convert_kana($request->keyword, 's');

            if (stripos($keyword, ' OR ') !== false) {
                //OR(orで区切って配列に分解)
                $keywords = preg_split('/\s+OR\s+/i', $keyword, -1, PREG_SPLIT_NO_EMPTY);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->orWhere('name', 'like', '%' . $word . '%');
                    }
                });
            }else {
                //AND(キーワードをスペースで区切る)
                $keywords = preg_split('/\s+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where('name', 'like', '%' . $word . '%');
                    }
                });
            }
        }

        //カテゴリ検索(カテゴリIDが渡されている場合)
        if ($request->filled('category_id')) {
            $categoryId = $request->category_id;
            $category = Category::with('children')->where('id', $categoryId)->first();


            if ($category) {
                if ($category->children->isNotEmpty()) {
                    //親カテゴリなら子カテゴリのIDで商品を絞り込む
                    $allCategoryIds = $category->children->pluck('id')->prepend($category->id);

                    $query->whereIn('category_id', $allCategoryIds);
                }else {
                    $query->where('category_id', $category->id);
                }
            }
        }

        //ソート機能(価格順等)
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        }elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }elseif ($request->sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        }

        //ページネーション
        $products = $query->paginate(12);

        //カテゴリリスト
        $categories = Category::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();

        $products->setCollection(
            $products->getCollection()->transform(function ($product) {
                $product->image_url = $product->image
                    ? asset('storage/img/products/' . $product->image)
                    : asset('images/no-image.png'); // fallback
                return $product;
            })
        );        

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('subImages')->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
