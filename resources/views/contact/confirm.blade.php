<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            お問い合わせ内容の確認
        </h2>
    </x-slot>

    @vite(['resources/css/contact/form.css'])

    <div class="contact-form-wrapper">
        <form method="POST" action="{{ route('contact.send') }}" id="contact-form">
            @csrf 

            <div class="form-group">
                <label>お名前</label>
                <p>{{ $name }}</p>
                <input type="hidden" name="name" value="{{ $name }}">
            </div>

            <div class="form-group">
                <label>メールアドレス</label>
                <p>{{ $email }}</p>
                <input type="hidden" name="email" value="{{ $email }}">
            </div>

            <div class="form-group">
                <label>お問い合わせ内容</label>
                <p>{!! nl2br(e($content)) !!}</p><!-- 文字列をエスケープしてnをbrに変換⇒htmlとして出力 --> 
                <input type="hidden" name="content" value="{{ e($content) }}">
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" onclick="history.back()" class="submit-button">戻る</button>
                <button type="submit" class="submit-button">送信</button>
            </div>
        </form>

        <!-- リキャプチャ --> 
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('contact-form');
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // デフォルトの送信を防ぐ

                    grecaptcha.ready(function () {
                        grecaptcha.execute('{{ config('services.recaptcha.site') }}', {action: 'submit'}).then(function(token) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'g-recaptcha-response';
                            input.value = token;
                            form.appendChild(input);

                            form.submit(); // reCAPTCHAトークンが追加されたあとで送信
                        });
                    });
                });
            });
        </script>    
    </div>
</x-app-layout>