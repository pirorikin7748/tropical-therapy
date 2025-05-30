<x-app-layout>
    @vite(['resources/css/mypage/common.css', 'resources/js/mypage/index.js'])

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            パスワード変更
        </h2>
    </x-slot>

    <div class="background-overlay"></div>

    <div class="password-reset-form mx-auto mt-10 bg-white shadow-md rounded px-8 py-8 max-w-xl">
        <h2 class="text-center text-xl font-bold mb-4">パスワード再設定</h2>
        <p class="text-center text-sm text-gray-600 mb-6">
            安全を確保する為にパスワードは8桁以上で入力してください。
        </p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-4">
                <x-input-label for="current_password" :value="'現在のパスワード'" />
                <x-text-input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="'新しいパスワード'" />
                <x-text-input id="password" name="password" type="password" class="form-input" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="'パスワード再入力'" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            @if (session('status') === 'password-updated')
                <div class="text-center text-green-600 mb-4">
                    パスワードを変更しました。
                </div>
            @endif

            <div class="text-center">
                <button type="submit" class="b-nav-button">保存</button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('mypage') }}" class="b-nav-button">マイページへ戻る</a>
        </div>
    </div>
</x-app-layout>