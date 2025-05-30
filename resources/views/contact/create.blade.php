<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            お問い合わせフォーム
        </h2>
    </x-slot>

    @vite(['resources/css/contact/form.css'])

    <div class="contact-form-wrapper">
        <form method="POST" action="{{ route('contact.confirm') }}">
            @csrf 

            <div class="form-group">
                <label for="name">お名前<span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">メールアドレス<span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="content">お問い合わせ内容<span class="text-red-500">*</span></label>
                <textarea id="content" name="content" rows="6">{{ old('content') }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="submit-button">登録確認</button>
            </div>
        </form>
    </div>
</x-app-layout>