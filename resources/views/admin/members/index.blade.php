<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員一覧</title>
    @vite(['resources/css/admin/members.css', 'resources/js/app.js'])
</head>
<body class="relative">
    <div class="min-h-screen bg-white/80 p-6">
        <div class="relative z-10">
            <form method="GET" action="{{ route('admin.members.index') }}" class="search-form mb-6">
                <div>
                    <label>ステータス:</label>
                    <select name="status">
                        <option value="">全て</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>会員</option>
                        <option value="withdrawn" {{ request('status') == 'withdrawn' ? 'selected' : '' }}>退会済み</option>
                    </select>
                </div>
                <div>
                    <label>名前検索:</label>
                    <input type="text" name="name" value="{{ request('name') }}">
                </div>
                <div>
                    <label>並び順:</label>
                    <select name="sort">
                        <option value="kana" {{ request('sort') == 'kana' ? 'selected' : '' }}>ふりがな</option>
                        <option value="registered_at" {{ request('sort') == 'registered_at' ? 'selected' : '' }}>登録日時</option>
                    </select>
                    <select name="order">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>昇順</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>降順</option>
                    </select>
                </div>
                <button type="submit">検索</button>
                <div class="csv-links">
                    <a href="{{ route('admin.members.csv', request()->query()) }}">CSVダウンロード</a>
                </div>
            </form>

            <form method="POST" action="{{ route('admin.members.withdraw') }}">
                @csrf
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="toggleAll(this)"></th>
                                <th>会員番号</th>
                                <th>お名前</th>
                                <th>お名前（カナ）</th>
                                <th>住所</th>
                                <th>電話番号</th>
                                <th>登録日時</th>
                                <th>ステータス</th>
                                <th>編集</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td><input type="checkbox" name="member_ids[]" value="{{ $member->id }}"></td>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->family_name }} {{ $member->first_name }}</td>
                                <td>{{ $member->family_name_kana }} {{ $member->first_name_kana }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->tel1 }} {{ $member->tel2 }} {{ $member->tel3 }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->deleted_at ? '退会済み' : '会員' }}</td>
                                <td>
                                    @if (is_null($member->deleted_at))
                                        <a href="{{ route('admin.members.edit', $member->id) }}" class="text-blue-500 underline">変更</a>
                                    @else 
                                        <span class="text-gray-400">編集不可</span>
                                    @endif 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="action-button">
                        <button type="submit" onclick="return confirmWithdraw()">選択した会員を退会</button>
                    </div>
                </div>
            </form>

            <div class="pagination-container mt-6 text-center">
                <div class="pagination-info">
                    {{ $members->total() }}件中 {{ $members->firstItem() }}～{{ $members->lastItem() }}件表示
                </div>
                <div class="pagination">
                    {{ $members->links('vendor.pagination.default') }}
                </div>
            </div>

            <div class="top-links">
                <a href="{{ route('admin.dashboard') }}">トップページ</a>
            </div>

        </div>
    </div>
</body>
<script>
    function toggleAll(checkbox) {
        const checkboxes = document.querySelectorAll('input[name="member_ids[]"]');
        checkboxes.forEach(cb => cb.checked = checkbox.checked);
    }

    function confirmWithdraw() {
        const selected = document.querySelectorAll('input[name="member_ids[]"]:checked');
        if (selected.length === 0) {
            alert('会員が選択されていません。');
            return false;
        }

        return confirm('本当に退会させますか？');
    }
</script>
</html>
