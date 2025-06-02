<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品確認</title>
    @vite(['resources/css/admin/products-confirm.css'])
</head>
<body>
<div class="product-confirm-container">
    <h1>商品確認</h1>

    <table class="confirm-table">
        <tr>
            <th>商品名</th>
            <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
            <th>商品説明</th>
            <td>{!! nl2br(e($data['detail'])) !!}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>￥{{ number_format($data['price']) }}</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $data['category_label'] }}</td>
        </tr>
        @php use Illuminate\Support\Str; @endphp 

        @if (!empty($data['main_temp_path']))
            <tr>
                <th>メイン画像</th>
                <td>
                    <img src="{{ asset('storage/' . Str::after($data['main_temp_path'], 'public/') ) }}" alt="メイン画像" class="image-preview"><br>
                    {{ $data['main_image_name'] }}
                </td>
            </tr>
        @endif
        @if (!empty($sub_images))
            <tr>
                <th>サブ画像</th>
                <td>
                    @foreach ($sub_images as $img)
                        <div class="sub-image-block">
                            <img src="{{ asset('storage/' . Str::after($img['path'], 'public/') ) }}" alt="サブ画像" class="sub-image-preview"><br>
                            {{ $img['name'] }}
                        </div>
                    @endforeach
                </td>
            </tr>
        @endif
    </table>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf
        @if (!empty($data['main_temp_path']))
            <input type="hidden" name="main_temp_path" value="{{ $data['main_temp_path'] }}">
            <input type="hidden" name="main_image_name" value="{{ $data['main_image_name'] }}">
        @endif
        @foreach ($data as $key => $value)
            @if (!is_array($value))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
        @foreach ($sub_images as $img)
            <input type="hidden" name="sub_temp_paths[]" value="{{ $img['path'] }}">
            <input type="hidden" name="sub_image_names[]" value="{{ $img['name'] }}">
        @endforeach

        <div class="button-group center">
            <button type="submit">この内容で登録</button>
        </div>
    </form>

    <form method="GET" action="{{ route('admin.products.create') }}">
        <div class="button-group center">
            <button type="submit" class="back-btn">修正する</button>
        </div>
    </form>

    <div class="links">
        <a href="{{ route('admin.products.index') }}">商品一覧へ</a>
        <a href="{{ route('admin.dashboard') }}">トップページへ</a>
    </div>
</div>
</body>
</html>
