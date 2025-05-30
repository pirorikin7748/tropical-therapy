<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function destroy($id)
    {
        $favorite = Favorite::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$favorite) {
            abort(404, 'お気に入りが見つかりません。');
        }

        $favorite->delete();

        return redirect()->route('mypage.favorites')->with('status', 'お気に入りから削除しました。');
    }
}
