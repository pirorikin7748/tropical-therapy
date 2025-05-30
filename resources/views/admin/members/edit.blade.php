<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員情報変更</title>
    @vite(['resources/css/admin/edit.css'])
</head>
<body>
    <div class="container">
        <h2>会員情報変更</h2>

        <form method="POST" action="{{ route('admin.members.update', $member->id) }}">
            @csrf

            <label>姓:</label>
            <input type="text" name="family_name" value="{{ old('family_name', $member->family_name) }}">
            @error('family_name') <div class="error">{{ $message }}</div> @enderror

            <label>名:</label>
            <input type="text" name="first_name" value="{{ old('first_name', $member->first_name) }}">
            @error('first_name') <div class="error">{{ $message }}</div> @enderror

            <label>姓（カナ）:</label>
            <input type="text" name="family_name_kana" value="{{ old('family_name_kana', $member->family_name_kana) }}">
            @error('family_name_kana') <div class="error">{{ $message }}</div> @enderror

            <label>名（カナ）:</label>
            <input type="text" name="first_name_kana" value="{{ old('first_name_kana', $member->first_name_kana) }}">
            @error('first_name_kana') <div class="error">{{ $message }}</div> @enderror

            <label>住所:</label>
            <input type="text" name="address" value="{{ old('address', $member->address) }}">
            @error('address') <div class="error">{{ $message }}</div> @enderror

            <label>電話番号:</label>
            <div class="tel-group">
                <input type="text" name="tel1" value="{{ old('tel1', $member->tel1) }}">
                <input type="text" name="tel2" value="{{ old('tel2', $member->tel2) }}">
                <input type="text" name="tel3" value="{{ old('tel3', $member->tel3) }}">
            </div>
            @error('tel1') <div class="error">{{ $message }}</div> @enderror
            @error('tel2') <div class="error">{{ $message }}</div> @enderror
            @error('tel3') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn-submit">更新</button>
        </form>
    </div>
</body>
</html>