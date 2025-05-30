<x-guest-layout>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf 

        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />
            <div class="relative"> 
                <x-text-input id="password" type="password" name="password" class="block mt-1 w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword()">
                    <i class="fa fa-eye" id="togglePasswordIcon"></i>    
                </span>
            </div>
        </div>

        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('togglePasswordIcon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>

        <div class="mt-4">
            <x-primary-button>ログイン</x-primary-button>
        </div>

        <div class="mt-4 text-sm text-right">
            <a href="{{ route('admin.password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                パスワードをお忘れの方はこちら
            </a>
        </div>

        @if ($errors->has('recaptcha'))
            <div class="text-red-500 text-sm mt-2">
                {{ $errors->first('recaptcha') }}
            </div>
        @endif
        
        <input type="hidden" name="recaptcha_token" id="recaptcha_token">
    </form>

    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site') }}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config('services.recaptcha.site') }}', {action: 'admin_login'}).then(function(token) {
                document.getElementById('recaptcha_token').value = token; 
            });
        });
    </script>
</x-guest-layout>