<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">配送先の確認</h2>
    </x-slot>

    @vite(['resources/css/checkout/index.css'])

    <div class="checkout-container">
        <form action="{{ route('checkout.confirm') }}" method="POST">
            @csrf
            <div class="checkout-box">
                <label for="family_name">姓</label>
                <input type="text" id="family_name" name="family_name" value="{{ old('family_name', $user->family_name) }}">
            </div>

            <div class="checkout-box">
                <label for="first_name">名</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
            </div>

            <div class="checkout-box">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="checkout-box">
                <label for="tel">電話番号</label>
                <div class="tel-group"> 
                    <input type="text" name="tel1" value="{{ old('tel1', $user->tel1) }}" maxlength="3"> - 
                    <input type="text" name="tel2" value="{{ old('tel2', $user->tel2) }}" maxlength="4"> - 
                    <input type="text" name="tel3" value="{{ old('tel3', $user->tel3) }}" maxlength="4">
                </div> 
            </div>

            <div class="checkout-box">
                <label for="zip">郵便番号</label>
                <div class="zip-group"> 
                    <input type="text" id="zip1" name="zip1" value="{{ old('zip1', $user->zip1 ?? '') }}"> - 
                    <input type="text" id="zip2" name="zip2" value="{{ old('zip2', $user->zip2 ?? '') }}">
                </div>
            </div>

            <div class="checkout-box">
                <label>住所</label>
                <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="checkout-button">確認画面へ進む</button>
            </div> 
        </form>
    </div>
</x-app-layout>