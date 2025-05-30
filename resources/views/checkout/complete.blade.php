<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">ご注文完了</h2>
    </x-slot>

    @vite(['resources/css/checkout/complete.css'])    

    <div class="checkout-complete-container">
        <p class="text-xl text-center mt-6 font-bold">ご購入ありがとうございました。</p>
        <p class="text-center mt-2">ご注文内容の確認メールを送信しました。</p>

        <div class="text-center mt-6">
            <a href="{{ route('products.index') }}" class="back-button">商品一覧へ戻る</a>
        </div>
    </div>
</x-app-layout>