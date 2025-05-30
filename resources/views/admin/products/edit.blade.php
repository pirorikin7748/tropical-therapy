<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>商品情報変更</title>
        @vite(['resources/css/admin/products-edit.css'])
    </head>
    <body>
        <div class="product-edit-container">
            <h1>商品情報変更</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf 
                @method('PUT')

                <div class="form-group">
                    <label for="name">商品名:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
                </div>

                <div class="form-group">
                    <label for="detail">商品説明:</label>
                    <textarea id="detail" name="detail" rows="6">{{ old('detail', $product->detail) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">価格:</label>
                    <input type="text" id="price" name="price" value="{{ old('price', intval($product->price)) }}">
                </div>

                <div class="form-group">
                    <label for="ctg_id">カテゴリー:</label>
                    <select id="ctg_id" name="ctg_id">
                        @foreach ($categories as $cat)
                            @if ($cat->parent_id !== null)
                                <option value="{{ $cat->id }}" {{ $cat->id == $product->ctg_id ? 'selected' : '' }}>
                                    {{ $cat->label }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="main_image">メイン画像:</label>
                    <input type="file" id="main_image" name="main_image">
                    @if ($product->image)
                        <div class="image-preview">
                            <img src="{{ asset('img/products/' . $product->image) }}" alt="メイン画像">
                        </div>
                    @endif 
                </div>

                <div class="form-group">
                    <label for="sub_images">サブ画像（複数可）:</label>
                    <input type="file" id="sub_images" name="sub_images[]" multiple>

                    @foreach ($subImages as $subImage)
                        <div class="sub-image-preview">
                            <img src="{{ asset('img/products/sub/' . $subImage->image_path) }}" alt="サブ画像">
                            <div class="delete-checkbox">
                                <input type="checkbox" name="delete_sub_images[]" value="{{ $subImage->id }}" id="delete_{{ $subImage->id }}">
                                <label for="delete_{{ $subImage->id }}">削除する</label>
                            </div>
                        </div>
                    @endforeach 
                </div>

                <div class="form-group submit-group">
                    <button type="submit">更新</button>
                </div>
            </form>

            <div class="links">
                <a href="{{ route('admin.products.index') }}">商品一覧へ</a>
                <a href="{{ route('admin.dashboard') }}">トップページへ</a>
            </div>
        </div>
    </body>
</html>