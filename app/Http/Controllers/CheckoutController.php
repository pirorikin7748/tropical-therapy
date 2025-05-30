<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderCompleteMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('checkout.index', compact('user'));
    }

    public function confirm(Request $request)
    {
        //受け取った配送先情報をsessionへ
        $checkoutData = $request->all();
        session(['checkout_data' => $checkoutData]);

        //ログインしているユーザーのカート内容取得
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        //合計金額の計算
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->num;
        });

        return view('checkout.confirm', [
            'checkout' => $checkoutData,
            'cartItems' => $cartItems,
            'total' => $total,
            'stripePublicKey' => config('services.stripe.key')
        ]);
    }

public function complete(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $paymentMethodId = $request->input('payment_method');
    $amount = $request->input('amount');

    try {
        $intent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'jpy',
            'payment_method' => $paymentMethodId,
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
            'confirm' => true,
        ]);
        Log::debug(" stripe payment success!");
    } catch (\Exception $e) {
        Log::error('決済エラー: ' . $e->getMessage());
        return back()->withErrors(['message' => '決済エラー: ' . $e->getMessage()]);
    }

    $checkout = session('checkout_data');
    $user = Auth::user();

    // 注文保存
    $order = Order::create([
        'user_id' => $user->id,
        'total_price' => $amount,
        'postcode' => $checkout['zip1'] . '-' . $checkout['zip2'],
        'address' => $checkout['address'],
        'tel' => $checkout['tel1'] . '-' . $checkout['tel2'] . '-' . $checkout['tel3'],
    ]);

    // カート取得・注文商品保存
    $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->num,
            'price' => $item->product->price,
            'size' => $item->size,
        ]);
    }

    // カート削除
    Cart::where('user_id', $user->id)->delete();

    // セッション削除
    session()->forget('checkout_data');

    // メール送信
    try {
        $order->load('user');
        Mail::to($user->email)->send(new OrderCompleteMail($order));
        Log::debug(" mail sent");
    } catch (\Exception $e) {
        Log::error(" mail send failed: " . $e->getMessage());
    }

    // thanksページへ遷移
    try {
        return redirect()->route('checkout.complete.thanks');
    } catch (\Exception $e) {
        Log::error("メール送信失敗: " . $e->getMessage());
        return response("redirect error", 500);
    }
}};
