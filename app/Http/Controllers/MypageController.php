<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Order;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('mypage.index', compact('user'));
    }

    public function favorites()
    {
        $user = Auth::user();
        //お気に入り商品一覧
        $favorites = Favorite::with('product')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'asc')
        ->paginate(6);

        return view('mypage.favorites', compact('user', 'favorites'));
    }

    public function orders()
    {
        $user = Auth::user();

        $orders = Order::with(['orderItems.product'])
            ->where('user_id', $user->id) //eager loadで商品名・画像等取得
            ->orderBy('created_at', 'desc')
            ->paginate(5);

            return view('mypage.orders', compact('user', 'orders'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('mypage.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'family_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'family_name_kana' => 'nullable|string|max:255',
            'first_name_kana' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'tel1' => 'nullable|string|max:5',
            'tel2' => 'nullable|string|max:5',
            'tel3' => 'nullable|string|max:5',
        ]);

        $user->update($validated);

        return redirect()->route('mypage.profile')->with('status', '会員情報を更新しました。');
    }

    public function withdraw (Request $request)
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();
        return redirect('/products')->with('status', '退会処理が完了しました。またのご利用をお待ちしています。');
    }
}
