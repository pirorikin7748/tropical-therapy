<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Family Name -->
        <div>
            <x-input-label for="family_name" :value="__('Family Name')" />
            <x-text-input id="family_name" class="block mt-1 w-full" type="text" name="family_name" :value="old('family_name')" required autofocus />
            <x-input-error :messages="$errors->get('family_name')" class="mt-2" />
        </div>

        <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Family Name Kana -->
        <div class="mt-4">
            <x-input-label for="family_name_kana" :value="__('Family Name Kana')" />
            <x-text-input id="family_name_kana" class="block mt-1 w-full" type="text" name="family_name_kana" :value="old('family_name_kana')" required />
            <x-input-error :messages="$errors->get('family_name_kana')" class="mt-2" />
        </div>

        <!-- First Name Kana -->
        <div class="mt-4">
            <x-input-label for="first_name_kana" :value="__('First Name Kana')" />
            <x-text-input id="first_name_kana" class="block mt-1 w-full" type="text" name="first_name_kana" :value="old('first_name_kana')" required />
            <x-input-error :messages="$errors->get('first_name_kana')" class="mt-2" />
        </div>

        <!-- Sex -->
        <div class="mt-4">
            <x-input-label for="sex" :value="__('Sex')" />
            <div>
                <label><input type="radio" name="sex" value="1" {{ old('sex') == '1' ? 'checked' : '' }}> {{ __('male') }}</label>
                <label class="ml-4"><input type="radio" name="sex" value="2" {{ old('sex') == '2' ? 'checked' : '' }}> {{ __('female') }}</label>
            </div>
            <x-input-error :messages="$errors->get('sex')" class="mt-2" />
        </div>

        <!-- Birthdate -->
        <div class="mt-4">
            <x-input-label for="birth" :value="__('Birth Date')" />
            <div class="grid grid-cols-3 gap-2">
                <select name="year" required class="block mt-1 w-full">
                    <option value="">Year</option>
                    @for ($i = date('Y'); $i >= 1900; $i--)
                        <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <select name="month" required class="block mt-1 w-full">
                    <option value="">Month</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ sprintf('%02d', $i) }}" {{ old('month') == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <select name="day" required class="block mt-1 w-full">
                    <option value="">Day</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ sprintf('%02d', $i) }}" {{ old('day') == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>     
            </div>
            <x-input-error :messages="$errors->get('year')" class="mt-2" />
            <x-input-error :messages="$errors->get('month')" class="mt-2" />
            <x-input-error :messages="$errors->get('day')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="mt-4">
            <x-input-label :value="__('Postal Code')" />
            <div class="flex space-x-2">
                <x-text-input id="zip1" name="zip1" class="w-1/3" type="text" :value="old('zip1')" maxlength="3"
                onKeyUp="AjaxZip3.zip2addr('zip1','zip2','address','address');" required />-
                <x-text-input id="zip2" name="zip2" class="w-1/3" type="text" :value="old('zip2')" maxlength="4"
                onKeyUp="AjaxZip3.zip2addr('zip1','zip2','address','address');" required />
            </div>
            <x-input-error :messages="$errors->get('zip1')" class="mt-2" />
            <x-input-error :messages="$errors->get('zip2')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label :value="__('Phone Number')" />
            <div class="flex space-x-2">
                <x-text-input name="tel1" class="w-1/3" :value="old('tel1')" required />
                <span class="self-center">-</span>
                <x-text-input name="tel2" class="w-1/3" :value="old('tel2')" required />
                <span class="self-center">-</span> 
                <x-text-input name="tel3" class="w-1/3" :value="old('tel3')" required />
            </div>
            <x-input-error :messages="$errors->get('tel1')" class="mt-2" />
            <x-input-error :messages="$errors->get('tel2')" class="mt-2" />
            <x-input-error :messages="$errors->get('tel3')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <span id="togglePassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                    <i class="fas fa-eye"></i>
                </span> 
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <span id="toggleConfirmPassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            //パスワードの切り替え
            togglePassword?.addEventListener("click", () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                togglePassword.innerHTML = type === 'password'
                    ? '<i class="fas fa-eye"></i>'
                    : '<i class="fas fa-eye-slash"></i>';
            });

            //確認用パスワード切り替え
            toggleConfirmPassword?.addEventListener("click", () => {
                const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
                confirmPasswordInput.type = type;
                toggleConfirmPassword.innerHTML = type === 'password'
                    ? '<i class="fas fa-eye"></i>'
                    : '<i class="fas fa-eye-slash"></i>';
            });
        });
    </script>
</x-guest-layout>
