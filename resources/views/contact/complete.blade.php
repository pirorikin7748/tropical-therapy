<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            お問い合わせ完了
        </h2>
    </x-slot>
    @vite(['resources/css/contact/form.css'])

    <div class="contact-form-wrapper text-center">
        <p>お問い合わせありがとうございました。後日、メールアドレス宛に返信させていただきます。</p>
        <a href="{{ route('products.index') }}" class="submit-button mt-6 inline-block">商品一覧へ戻る</a>
    </div>
</x-app-layout>