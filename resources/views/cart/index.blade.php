<x-app-layout>
    <x-slot name="header">
        <h2 class="cart-title">カート</h2>
    </x-slot>

    @vite(['resources/css/cart/index.css'])

    <div class="cart-container">
        @if ($cartItems->isEmpty())
            <p class="cart-empty-message">カートに商品がありません。</p>
            <a href="{{ route('products.index') }}" class="cart-link">商品一覧へ戻る</a>
        @else
            <table class="cart-table">
                <thead>
                        <th class="p-2">商品名</th>
                        <th class="p-2">価格</th>
                        <th class="p-2">サイズ</th>
                        <th class="p-2">数量</th>
                        <th class="p-2">小計</th>
                        <th class="p-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php 
                            $subtotal = $item->product->price * $item->num;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td data-label="商品名">{{ $item->product->name }}</td>
                            <td data-label="価格">{{ number_format($item->product->price) }}</td>
                            <td data-label="サイズ">{{ $item->size }}</td>
                            <td data-label="数量">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="cart-inline-form">
                                   @csrf 
                                   <input type="number" name="quantity" value="{{ $item->num }}" min="1" class="cart-quantity-input">
                                   <button type="submit" class="cart-button">変更</button>
                                </form>
                            </td>
                            <td data-label="小計">{{ number_format($subtotal) }}</td>
                            <td data-label="操作">
                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                    @csrf 
                                    <button type="submit" class="cart-button">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="cart-total-row">
                        <td colspan="4" class="cart-total-label">合計金額</td>
                        <td class="cart-total-price">￥{{ number_format($total) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="cart-actions">
                <a href="{{ route('checkout.index') }}" class="cart-button">購入手続きへ</a>
                <a href="{{ route('products.index') }}" class="cart-button">買い物を続ける</a>
            </div>
        @endif
    </div>
</x-app-layout>