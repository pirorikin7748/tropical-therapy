<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <!-- 左側ブロック -->
            <div class="flex items-center gap-4">
                <!-- ロゴ -->
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>

                <!-- メニュー -->
                <a href="{{ route('products.index') }}" class="text-sm font-bold">ホーム</a>
                <a href="{{ route('mypage') }}" class="text-sm font-bold">マイページ</a>
                <a href="{{ route('contact.create') }}" class="text-sm font-bold">お問い合わせ</a>

                @auth
                    <span class="text-sm">こんにちは {{ Auth::user()->family_name }} さん</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-600 text-sm ml-2">ログアウト</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 text-sm font-bold">ログイン</a>
                @endauth
            </div>

            <div class="flex items-center gap-4">
                <!-- カートリンク -->
                <a href="{{ route('cart.index') }}" class="text-sm font-bold">カートを見る</a>

                <!-- Vueマウントポイント（カテゴリ + 検索） -->
                <div id="header-search" class="min-w-[260px]">
                    <header-search></header-search>
                </div>
            </div>        
        
        </div>
    </div>
</nav>