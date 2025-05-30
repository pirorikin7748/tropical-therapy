<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ダッシュボード</title>
    @vite(['resources/css/admin/dashboard.css', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-container">
        <h1>ようこそ、{{ Auth::guard('admin')->user()->name }} さん！</h1>

        <div class="admin-menu">
            <a href="{{ route('admin.members.index') }}">会員一覧</a>
            <a href="{{ route('admin.inquiries.index') }}">お問い合わせ一覧</a>
            <a href="{{ route('admin.products.index') }}">商品一覧</a>
            <a href="{{ route('admin.sales.index') }}">売上管理</a>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-link">ログアウト</button>
        </form>
    </div>
</body>
</html>