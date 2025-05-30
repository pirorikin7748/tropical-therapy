<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規商品登録</title>
    @vite(['resources/css/admin/products-create.css'])
</head>
<body>
    <div class="product-create-container">
        <h1>新規商品登録</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.products.confirm') }}" enctype="multipart/form-data">
            @csrf

            <table class="product-form-table">
                <tr>
                    <th><label for="name">商品名:</label></th>
                    <td><input type="text" id="name" name="name" value="{{ old('name') }}"></td>
                </tr>
                <tr>
                    <th><label for="detail">商品説明:</label></th>
                    <td><textarea id="detail" name="detail" rows="6">{{ old('detail') }}</textarea></td>
                </tr>
                <tr>
                    <th><label for="price">価格:</label></th>
                    <td><input type="text" id="price" name="price" value="{{ old('price') }}"></td>
                </tr>
                <tr>
                    <th><label for="ctg_id">カテゴリー:</label></th>
                    <td>
                        <select id="ctg_id" name="ctg_id">
                            @foreach ($categories as $cat)
                                @if ($cat->parent_id !== null)
                                    <option value="{{ $cat->id }}" {{ old('ctg_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->label }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="main_image">メイン画像:</label></th>
                    <td><input type="file" id="main_image" name="main_image"></td>
                </tr>
                <tr>
                    <th><label for="sub_images">サブ画像（複数可）:</label></th>
                    <td><input type="file" id="sub_images" name="sub_images[]" multiple></td>
                </tr>
            </table>

            <div class="form-group center">
                <button type="submit">登録確認</button>
            </div>
        </form>

        <div class="links">
            <a href="{{ route('admin.products.index') }}">商品一覧へ</a>
            <a href="{{ route('admin.dashboard') }}">トップページへ</a>
        </div>
    </div>
</body>
</html>
