<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        //同じ商品・同じサイズがカートに存在するか確認
        $existing = Cart::where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->where('size', $validated['size'])
            ->first();

        if ($existing) {
            //数量の加算
            $existing->num += $validated['quantity'];
            $existing->save();
        }else {
            //新規カートアイテムの作成
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
                'size' => $validated['size'],
                'num' => $validated['quantity'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'カートに追加しました');
    }

    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->num = $request->quantity;
        $cart->save();

        return redirect()->route('cart.index');
    }

    public function delete($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->delete();

        return redirect()->route('cart.index');
    }
}
