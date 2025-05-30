@php 
    use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    @vite(['resources/css/products/index.css', 'resources/js/app.js'])

    <div id="app-products" class="py-8 px-4 mb-16">
        <!-- Vue全体マウント（App.vue） -->
    </div>

    <script>
        window.App = {
            isLoggedIn: @json(Auth::check())
        };
    </script>
</x-app-layout>
