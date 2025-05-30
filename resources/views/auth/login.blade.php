<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block mt-1 w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                
                <!-- 目のアイコン -->
                 <span id="togglePassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                    <i class="fas fa-eye"></i>
                 </span>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center text-sm text-gray-600">
            アカウントをお持ちでない方は
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-900 underline">
                新規登録はこちら
            </a>
        </div>
        
        <input type="hidden" name="recaptcha_token" id="recaptchaToken">
    </form>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#togglePassword");
            const passwordInput = document.querySelector("#password");

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener("click", function () {
                    const type = passwordInput.type === "password" ? "text" : "password";
                    passwordInput.type = type;
                    this.innerHTML = type === "password"
                        ? '<i class="fas fa-eye"></i>'
                        : '<i class="fas fa-eye-slash"></i>';
                });
            }

            //recaptchaトークン取得
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ config('services.recaptcha.site') }}', {action: 'login'}).then(function (token) {
                    document.getElementById('recaptchaToken').value = token;
                });
            });
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site') }}"></script>   
    @endpush
</x-guest-layout>
