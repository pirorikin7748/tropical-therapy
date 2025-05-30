<x-app-layout bodyClass="bg-large-fix">
    @vite(['resources/css/mypage/orders.css', 'resources/js/mypage/index.js'])

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            購入履歴
        </h2>
    </x-slot>

    <div class="background-overlay"></div>

    <div class="mypage-orders max-w-5xl mx-auto p-6">
        @foreach ($orders as $order)
            <div class="order-box">
                <div class="order-header">
                    注文日: {{ $order->created_at->format('Y年m月d日 H:i') }} / 注文番号: #{{ $order->id }} 
                </div>
                <div class="order-total">合計金額: {{ number_format($order->total_price) }}円</div>

                @foreach ($order->orderItems as $item)
                    <div class="order-item">
                        @if ($item->product && $item->product->image)
                            <img src="{{ asset('img/products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        @endif 
                        <div> 
                            <div class="font-bold">{{ $item->product->name }}</div>
                            <div class="text-sm">数量: {{ $item->quantity }} / サイズ: {{ $item->size }} / 価格: {{number_format($item->price) }}円</div>
                        </div>
                    </div>
                @endforeach 
            </div>
        @endforeach 

        @if ($orders->isEmpty())
            <p class="no-data-message">購入履歴がありません。</p>
        @endif 

        <div class="pagination-wrapper mt-6">
            {{ $orders->links('vendor.pagination.custom') }}
        </div>

        <div class="back-buttons">
            <a href="{{ route('products.index') }}" class="b-nav-button">商品一覧へ</a>
            <a href="{{ route('mypage') }}" class="b-nav-button">マイページへ戻る</a>
        </div>

    </div>
</x-app-layout>