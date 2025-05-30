<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    @vite(['resources/css/admin/products.css', 'resources/js/app.js'])
</head>
<body>
<div class="admin-container">
    <h1>商品一覧</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif    

    <form method="GET" action="{{ route('admin.products.index') }}" class="search-form">
        <div class="search-group">
            <label>カテゴリ絞り込み:
                <select name="category_id">
                    <option value="">全て</option>
                    @foreach ($categories as $cat)
                        @if ($cat->parent_id !== null)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->label }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </label>

            <label>商品検索:
                <input type="text" name="keyword" value="{{ request('keyword') }}">
            </label>

            <label>並び順:
                <select name="sort_column">
                    <option value="category_id" {{ $sortColumn == 'ctg_id' ? 'selected' : '' }}>カテゴリID</option>
                    <option value="name" {{ $sortColumn == 'name' ? 'selected' : '' }}>商品名</option>
                    <option value="price" {{ $sortColumn == 'price' ? 'selected' : '' }}>価格</option>
                </select>
            </label>

            <label>並び順（方向）:
                <select name="sort_direction">
                    <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>昇順</option>
                    <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>降順</option>
                </select>
            </label>

            <div class="button-group">
                <button type="submit">絞り込み</button>
                <a href="{{ route('admin.products.csv', request()->query()) }}" class="csv-link">CSVダウンロード</a>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.products.onDelete') }}" onsubmit="return productWithdraw();"> 
        @csrf 
        <div class="table-container"> 
            <table>
                <thead>
                <tr>
                    <th><input type="checkbox" onclick="toggleAll(this)"></th>
                    <th>ID</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>価格</th>
                    <th>カテゴリID</th>
                    <th>画像</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}"></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            {{ Str::limit($product->detail, 20) }}
                            <a href="#" onclick="openModal('{{ $product->id }}')">全文を見る</a>

                            <div id="modal-{{ $product->id }}" class="modal hidden">
                                <div class="modal-content">
                                    <span onclick="closeModal('{{ $product->id }}')">&times;</span>
                                    <p>{{ $product->detail }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ number_format($product->price) }}円</td>
                        <td>{{ $product->ctg_id }}</td>
                        <td>{{ $product->image }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}">編集</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="action-button">
                <button type="submit" onclick="return productWithdraw()">選択した商品を削除</button>
            </div>
        </div>
    </form>

    <div class="pagenation-container text-center mt-6">
        <div class="summary">
            {{ $products->total() }}件中 {{ $products->firstItem() }}～{{ $products->lastItem() }}件表示
        </div>
        
        <div class="text-center">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </div>

    <div class="action-links text-center mt-8">
        <a href="{{ route('admin.products.create') }}">新規商品登録</a>
        <a href="{{ route('admin.dashboard') }}">トップページへ</a>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(`modal-${id}`).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(`modal-${id}`).classList.add('hidden');
    }
    function toggleAll(checkbox) {
        const checkboxes = document.querySelectorAll('input[name="product_ids[]"]');
        checkboxes.forEach(cb => cb.checked = checkbox.checked);
    }

    function productWithdraw() {
        const selected = document.querySelectorAll('input[name="product_ids[]"]:checked');
        if (selected.length === 0) {
            alert('商品が選択されていません。');
            return false;
        }

        return confirm('本当に削除しますか？');
    }
</script>
</body>
</html>
