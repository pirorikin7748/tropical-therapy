<x-app-layout> 
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('お気に入り商品一覧') }}
        </h2>
    </x-slot>

    @vite(['resources/js/mypage/index.js', 'resources/css/mypage/favorites.css', 'resources/js/mypage/favorites.js'])

    <div class="background-overlay"></div>
    
    <div class="favorites-page">
        <div class="favorites-wrapper">
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif 

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($favorites as $item)
                    <div class="favorite-item">
                        {{-- 商品名とリンク --}}
                        <a href="{{ route('products.show', $item->product->id) }}">
                            {{ $item->product->name }}
                        </a>

                        {{-- 商品画像 --}}
                        @if ($item->product->image)
                            <img src="{{ asset('storage/img/products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        @endif 

                        {{-- 削除ボタン --}}
                        <div class="button-group">
                            <a href="{{ route('products.show', $item->product->id) }}" class="detail-button">詳細を見る</a>
                        
                            <form action="{{ route('favorites.destroy', $item->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf 
                                @method('DELETE') 
                                <button type="submit" class="favorite-button">お気に入り登録解除</button>  
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (count($favorites) === 0)
                <p class="no-data-message">お気に入り商品が登録されていません。</p>
            @endif 
        </div>
        <div class="pagination-wrapper">
            {{ $favorites->links('vendor.pagination.custom') }}
        </div>

        <div class="back-buttons">
            <a href="{{ route('products.index') }}" class="b-nav-button">商品一覧へ</a>
            <a href="{{ route('mypage') }}" class="b-nav-button">マイページへ戻る</a>
        </div>
    </div>
</x-app-layout>