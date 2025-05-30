<x-app-layout>
    @vite(['resources/css/mypage/profile.css', 'resources/js/mypage/index.js'])

    <x-slot name="header">
        <h2>会員情報の確認・編集</h2>
    </x-slot>

    <div class="background-overlay"></div>

    <div class="mypage-profile">
        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('mypage.update') }}">
            @csrf

            <div class="form-group">
                <label>氏名</label>
                <div class="form-row">
                    <input type="text" name="family_name" value="{{ old('family_name', $user->family_name) }}" class="form-input">
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label>カナ</label>
                <div class="form-row">
                    <input type="text" name="family_name_kana" value="{{ old('family_name_kana', $user->family_name_kana) }}" class="form-input">
                    <input type="text" name="first_name_kana" value="{{ old('first_name_kana', $user->first_name_kana) }}" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" value="{{ $user->email }}" class="form-input" disabled>
            </div>

            <div class="form-group">
                <label>住所</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-input">
            </div>

            <div class="form-group">
                <label>電話番号</label>
                <div class="form-row">
                    <input type="text" name="tel1" value="{{ old('tel1', $user->tel1) }}" class="form-input narrow">- 
                    <input type="text" name="tel2" value="{{ old('tel2', $user->tel2) }}" class="form-input narrow">-
                    <input type="text" name="tel3" value="{{ old('tel3', $user->tel3) }}" class="form-input narrow">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">変更</button>
            </div>
        </form>

        <hr class="divider">

        <div class="withdraw-section">
            <h3>退会する</h3>
            <p>アカウントを削除したい方はこちら</p>
            <form method="POST" action="{{ route('mypage.withdraw') }}">
                @csrf
                <button type="submit" onclick="return confirm('本当に退会しますか？')" class="withdraw-btn">
                    退会する
                </button>
            </form>

            <a href="{{ route('mypage') }}" class="back-btn">マイページへ戻る</a>
        </div>
    </div>
</x-app-layout>