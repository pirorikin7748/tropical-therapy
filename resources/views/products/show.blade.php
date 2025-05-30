<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">商品詳細</h2>
    </x-slot>

    {{-- Swiperライブラリ --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- 分離したCSS・JS --}}
    @vite(['resources/css/products/show.css', 'resources/js/products/show.js'])

    <div class="product-detail-page" data-is-guest="{{ Auth::guest() ? 'true' : 'false' }}">  
        <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow">
            <!-- Swiperスライダー -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    @foreach ($product->subImages as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset('img/products/sub/' . $img->image_path) }}" alt="サブ画像">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- 商品情報 -->
            <div class="product-info">
                <h1>{{ $product->name }}</h1>
                <p class="text-gray-700 mt-2">{{ $product->detail }}</p>
                <p class="price">￥{{ number_format($product->price) }}</p>
            </div>

            <!-- カート追加 --> 
            <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST"> 
                @csrf 
                <input type="hidden" name="product_id" value="{{ $product->id }}">

            <!-- サイズ選択 --> 
            <div class="form-group mt-4 cart-select-wrapper">
                <label for="size" class="block font-semibold">サイズ</label>
                <select name="size" id="size" class="cart-select">
                    <option value="">-- サイズを選択 --</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option> 
                </select>
            </div>

            <!-- 数量選択 --> 
            <div class="form-group mt-4 cart-select-wrapper">
                <label for="quantity" class="block font-semibold">数量</label>
                <select name="quantity" id="quantity" class="cart-select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor 
                </select>
            </div>

            <!-- カート追加 --> 
            <div class="form-submit mt-6 text-center">
                <button type="submit" class="submit-button">
                    カートに追加
                </button>
            </div>

            <div class="product-back-link mt-6">
                <a href="{{ route('products.index') }}" class="text-blue-500 underline">← 商品一覧へ戻る</a>
            </div>
        </div>
    </div>
</x-app-layout>