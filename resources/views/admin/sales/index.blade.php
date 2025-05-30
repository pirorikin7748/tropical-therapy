<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>売上・受注管理</title>
    @vite(['resources/css/admin/sales.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <h1 class="text-xl font-bold mb-6">売上・受注管理</h1>

    <!-- フィルター検索フォーム -->
    <form method="GET" action="{{ route('admin.sales.index') }}" class="flex flex-wrap gap-4 mb-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif 
        <label>
            開始日：
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border px-2 py-1">
        </label>
        <label>
            終了日：
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border px-2 py-1">
        </label>
        <label>
            並び順：
            <select name="sort_column" class="border px-2 py-1">
                <option value="created_at" {{ request('sort_column') === 'created_at' ? 'selected' : '' }}>日付</option>
                <option value="total_price" {{ request('sort_column') === 'total_price' ? 'selected' : '' }}>売上金額</option>
            </select>
        </label>
        <select name="sort_direction" class="border px-2 py-1">
            <option value="asc" {{ request('sort_direction') === 'asc' ? 'selected' : '' }}>昇順</option>
            <option value="desc" {{ request('sort_direction') === 'desc' ? 'selected' : '' }}>降順</option>
        </select>
        <button type="submit" class="bg-black text-white px-4 py-1 rounded">検索</button>

        <a href="{{ route('admin.sales.csv', request()->query()) }}" class="bg-white border border-purple-600 text-purple-600 hover:bg-purple-100 px-4 py-1 rounded">CSVダウンロード</a>
    </form>

    <!-- 売上集計 -->
    <div class="mb-4">
        <p><strong>注文数：</strong>{{ $total_count }}件</p>
        <p><strong>売上合計：</strong>&yen;{{ number_format($total_sum) }}</p>
    </div>

    <!-- 注文一覧テーブル -->
    <table class="w-full border-collapse border">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="border px-2 py-1">注文ID</th>
                <th class="border px-2 py-1">名前</th>
                <th class="border px-2 py-1">合計金額</th>
                <th class="border px-2 py-1">注文ステータス</th>
                <th class="border px-2 py-1">注文日時</th>
                <th class="border px-2 py-1">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="border px-2 py-1">{{ $order->id }}</td>
                    <td class="border px-2 py-1">
                        <strong>
                            @if ($order->user)
                                {{ $order->user->family_name }} {{ $order->user->first_name }}
                            @else 
                            <span class="text-gray-400 italic">不明</span>
                            @endif 
                        </strong>
                    </td>
                    <td class="border px-2 py-1">&yen;{{ number_format($order->total_price) }}</td>
                    <td class="border px-2 py-1">{{ $order->status }}</td>
                    <td class="border px-2 py-1">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="border px-2 py-1">
                        <form method="POST" action="{{ route('admin.sales.update', $order->id) }}" class="flex gap-2">
                            @csrf
                            <select name="status" class="border px-2 py-1">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>未処理</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>完了</option>
                                <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>キャンセル</option>
                            </select>
                            <button type="submit" class="bg-black text-white px-2 py-1 rounded">変更</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション・リンク -->
    <div class="pagination-container mt-6 text-center">
        <div class="text-sm text-gray-600 mb-2 text-center">
            {{ $orders->total() }}件中 {{ $orders->firstItem() }}～{{ $orders->lastItem() }}件表示
        </div>
        <div class="pagenation">
            {{ $orders->links('vendor.pagination.default') }}
        </div>
        <div class="top-link">
            <a href="{{ route('admin.dashboard') }}" class="text-purple-600 underline">トップページへ</a>
        </div>
    </div>
</body>
</html>
