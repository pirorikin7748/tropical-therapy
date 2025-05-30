<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせ返信</title>
        @vite(['resources/css/admin/reply_form.css', 'resources/js/app.js'])
    </head>
    <body>

        <div class="info-box">
            <p><strong>お問い合わせ番号：</strong>{{ $contact->id }}</p>
            <p><strong>名前：</strong>{{ $contact->name }}</p>
            <p><strong>メールアドレス：</strong>{{ $contact->email }}</p>
            <p><strong>送信日時：</strong>{{ $contact->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>お問い合わせ内容：</strong><br>{{ $contact->content }}</p>
        </div>

        <form action="{{ route('admin.inquiries.reply', $contact->id) }}" method="POST">
            @csrf 
            <textarea name="reply_message" placeholder="返信メッセージを入力してください。" required>{{ old('reply_message') }}</textarea>
            <button type="submit">送信する</button>
        </form>
            <a href="{{ route('admin.inquiries.index') }}">お問い合わせ一覧へ</a>
    </body>
</html>