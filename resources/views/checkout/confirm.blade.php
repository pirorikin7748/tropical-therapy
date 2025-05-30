<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">注文確認</h2>
    </x-slot>

    <script src="https://js.stripe.com/v3/"></script>
    @vite(['resources/js/checkout/stripe.js', 'resources/css/checkout/confirm.css'])

    <div class="checkout-confirm-container">
        @if (!empty($checkout) && isset($checkout['family_name']))
            <h2>配送先情報</h2>
            <p>氏名: {{ $checkout['family_name'] }} {{ $checkout['first_name'] }}</p>
            <p>メールアドレス: {{ $checkout['email'] }}</p>
            <p>郵便番号: {{ $checkout['zip1'] }}-{{ $checkout['zip2'] }}</p>
            <p>住所: {{ $checkout['address'] }}</p>
            <p>電話番号:  {{ $checkout['tel1'] }}-{{ $checkout['tel2'] }}-{{ $checkout['tel3'] }}</p>
        @else 
            <p class="text-red-500">配送先情報が見つかりません。</p>
        @endif 

        <h2 class="mt-8">カート内容</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>サイズ</th>
                    <th>数量</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td data-label="商品名">{{ $item->product->name }}</td>
                        <td data-label="価格">{{ number_format($item->product->price) }}</td>
                        <td data-label="サイズ">{{ $item->size }}</td>
                        <td data-label="数量">{{ $item->num }}</td>
                        <td data-label="小計">￥{{ number_format($item->product->price * $item->num) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right font-bold">合計金額</td>
                    <td class="font-bold">￥{{ number_format($total) }}</td>
                </tr>
            </tbody>
        </table>
        <h2>お支払情報</h2>

        <form id="payment-form" method="POST" action="{{ route('checkout.complete') }}">
            @csrf 

            <div id="card-element" class="card-element"></div>
            <input type="hidden" name="payment_method" id="payment-method">
            <input type="hidden" name="amount" value="{{ $total }}">

            <div class="text-center mt-4">
                <button id="submit-button" class="checkout-button">購入する</button>
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('checkout.index') }}" class="back-button">配送先を修正する</a>
            </div>
        </form>
    </div>

    <script> 
        window.stripePublicKey = "{{ $stripePublicKey }}";
    </script>
</x-app-layout>