<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', function (Request $request) {
    $query = Product::query();

    $genderNameJa = '全商品';
    $categoryLabel = '';

    // カテゴリ指定がある場合
    if ($request->filled('category_id')) {
        $category = Category::with('parent', 'children')->find($request->category_id);

        if ($category) {
            //子カテゴリがある場合は、親+子カテゴリで検索
            if ($category->children->isNotEmpty()) {
                $allCategoryIds = $category->children->pluck('id')->prepend($category->id)->unique();
                $query->whereIn('ctg_id', $allCategoryIds);
            }else {
                $query->where('ctg_id', $category->id);
            }

            $parentName = optional($category->parent)->name;
            $categoryLabel = ($parentName ? $parentName . ' - ' : '') . $category->name;

            if (in_array($parentName, ['メンズ', 'レディース'])) {
                $genderNameJa = $parentName;
            }
        } else {
            return response()->json([
                'error' => 'カテゴリが見つかりません',
                'category_id' => $request->category_id,
            ], 400); // ← エラーレスポンスを返す
        }
    } elseif ($request->filled('gender')) {
        $genderKeyword = $request->gender;
        $genderNameJa = $genderKeyword === 'men' ? 'メンズ' : ($genderKeyword === 'women' ? 'レディース' : '全商品');

        $parent = Category::whereNull('parent_id')->where('name', $genderNameJa)->first();
        if ($parent) {
            $childCategoryIds = $parent->children()->pluck('id')->toArray();
            $query->whereIn('ctg_id', $childCategoryIds);
        }
    }

    // キーワード検索
    if ($request->filled('keyword')) {
        $keyword = mb_convert_kana($request->keyword, 's');
        $keywords = stripos($keyword, ' OR ') !== false
            ? preg_split('/\s+OR\s+/i', $keyword, -1, PREG_SPLIT_NO_EMPTY)
            : preg_split('/\s+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);

        $query->where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->where('name', 'like', "%{$word}%");
            }
        });
    }

    // ソート
    if ($request->sort === 'price_asc') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'price_desc') {
        $query->orderBy('price', 'desc');
    } elseif ($request->sort === 'newest') {
        $query->orderBy('created_at', 'desc');
    }

    try {
        $pagination = $query->paginate(15)->appends($request->all());

        //ログインユーザーのproduct_id(お気に入り取得)
        $favorites = Auth::check()
            ? Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray()
            : [];

        //配列化
        $products = collect($pagination->items())->map(function ($product) use ($favorites) {
            $product->is_favorite = in_array($product->id, $favorites);

            $product->image_url = $product->image 
                ? asset('storage/img/products/' . $product->image)
                : asset('images/noimage.png');
                
            return $product;
        });

        return response()->json([
            'data' => $products,
            'current_page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
            'from' => $pagination->firstItem(),
            'to' => $pagination->lastItem(),
            'gender_label' => $genderNameJa,
            'category_label' => $categoryLabel,
            'keyword' => $request->keyword,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'サーバーエラー',
            'message' => $e->getMessage(), // これでVueにエラーの中身が表示される
        ], 500);
    }
});

Route::get('/categories', function () {
    return Category::with('children')->whereNull('parent_id')->get();
});

Route::middleware('auth:sanctum')->post('/favorite', function (Request $request) {
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
    ]);

    $user = Auth::user();

    $exists = Favorite::where('user_id', $user->id)->where('product_id', $request->product_id)->exists();

    if (!$exists) {
        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);
    }
    return response()->json(['status' => 'ok']);
});