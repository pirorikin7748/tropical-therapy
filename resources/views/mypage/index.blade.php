<x-app-layout>  
    <x-slot name="header">  
        <h2 class="text-xl font-semibold leading-tight text-gray-800"> 
            {{ __('マイページ') }}
        </h2>
    </x-slot>

    @vite(['resources/css/mypage/index.css', 'resources/js/mypage/index.js'])
    <div class="background-overlay"></div>
    <div class="mypage-container">
        <p class="greeting">{{ $user->family_name }}さん、ようこそ。</p>

        <div class="card-grid">
            <div class="card">
                <h3>お気に入り</h3>
                <a href="{{ route('mypage.favorites') }}">お気に入り商品一覧</a>
            </div>

            <div class="card">
                <h3>購入履歴</h3>
                <a href="{{ route('mypage.orders') }}">購入履歴</a>
            </div>

            <div class="card">
                <h3>パスワード</h3>
                <a href="{{ route('profile.edit') }}">パスワード再設定はこちら</a>
            </div>
        </div>

        <div class="card center-card">
            <h3>会員情報編集</h3>
            <a href="{{ route('mypage.profile') }}">会員情報の編集・退会</a>
        </div>

        <div class="home-button-wrapper">
            <a href="{{ route('products.index') }}" class="home-button">ホームへ</a>
        </div>
    </div>
</x-app-layout>