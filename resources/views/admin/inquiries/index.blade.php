<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせ一覧</title>
        @vite(['resources/css/admin/inquiries.css', 'resources/js/app.js'])
    </head>
    <body class="relative bg-white/80 min-h-screen p-6">
        
        <!-- 検索フォーム -->
         <form method="GET" action="{{ route('admin.inquiries.index') }}" class="search-form mb-6 flex gap-4 flex-wrap items-center">
            <label>
                ステータス:
                <select name="status" class="border px-2 py-1">
                    <option value="">全て</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>未対応</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>対応済み</option>
                </select>
            </label>

            <label>
                開始日：
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border px-2 py-1"> 
            </label>

            <label>
                終了日：
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border px-2 py-1">
            </label>

            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">検索</button>
        </form>

         <!-- 一覧テーブル --> 
         <table class="w-full border-collapse border">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border px-2 py-1">名前</th>
                    <th class="border px-2 py-1">メールアドレス</th>
                    <th class="border px-2 py-1">メッセージ</th>
                    <th class="border px-2 py-1">送信日時</th>
                    <th class="border px-2 py-1">ステータス</th>
                    <th class="border px-2 py-1">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr class="border">
                    <td class="border px-2 py-1">{{ $contact->name }}</td>
                    <td class="border px-2 py-1">{{ $contact->email }}</td>
                    <td class="border px-2 py-1">
                        {{ Str::limit($contact->content, 20) }}
                        <a href="#" onclick="showModal('message-{{ $contact->id }}')" class="text-purple-600 underline">全文を見る</a>
                        
                        <!-- モーダル：内容 --> 
                         <div id="message-{{ $contact->id }}" class="modal hidden">
                            <div class="modal-content">
                                <p><strong>お問い合わせ内容：</strong><br>{{ $contact->content }}</p>
                                <button onclick="closeModal('message-{{ $contact->id }}')" class="text-blue-600 underline">閉じる</button>
                            </div>
                         </div>
                    </td>
                    <td class="border px-2 py-1">{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="border px-2 py-1">
                        @if ($contact->status === 'replied')
                            <span class="inline-block bg-green-500 text-white text-sm px-2 py-0.5 rounded">対応済み</span><br>
                            {{ $contact->replied_at->format('Y-m-d H:i') }}<br>
                            <a href="#" onclick="showModal('reply-{{ $contact->id }}')" class="text-purple-600 underline">全文を見る</a>

                            <!-- モーダル返信内容 --> 
                             <div id="reply-{{ $contact->id }}" class="modal hidden">
                                <div class="modal-content">
                                    <p><strong>返信内容：</strong><br>{{ $contact->reply_message }}</p>
                                    <button onclick="closeModal('reply-{{ $contact->id }}')" class="text-blue-600 underline">閉じる</button>
                                </div>
                             </div>
                        @else 
                            <span class="inline-block bg-red-500 text-white text-sm px-2 py-0.5 rounded">未対応</span>
                        @endif 
                    </td>
                    <td class="border px-2 py-1">
                        <a href="{{ route('admin.inquiries.reply_form', $contact->id) }}" class="text-blue-600 underline">返信</a>
                    </td>
                </tr>
                @endforeach 
            </tbody>
         </table>

         <!-- ページネーション --> 
         <div class="pagination-container mt-8 text-center">
            <div class="pagination-info">
                {{ $contacts->total() }}件中 {{ $contacts->firstItem() }}～{{ $contacts->lastItem() }}件表示
            </div>
            <div class="pagenation">
                {{ $contacts->links('vendor.pagination.default') }}
            </div>
            <div class="top-link mt-4">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 underline">トップページへ</a>
            </div>
         </div>

        <!-- モーダルスクリプト --> 
        <script>
            function showModal(id) {
                document.getElementById(id).classList.remove('hidden');
            }
            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }
        </script>
    </body>
</html>