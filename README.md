Tropical Therapy - Laravel版 ファッションECサイト

Tropical Therapyは、メンズ・レディースのファッションアイテムを販売するECサイトです。本プロジェクトはLaravel 10とVue.jsを使用して構築されており、UIとUXを意識して豊富な機能を備えたデモサイトです。




---

 主な技術スタック
 PHP 8.2.12
 Laravel 10.48.29
 Vue 3 + Vite
 MySQL 
 Bladeテンプレート & Vueコンポーネントの構成
 javascript
 Stripe決済
 Tailwind CSS（一部独自CSS使用）
 認証機能：Laravel Breeze（ユーザー用） + 管理者用独自ガード
 reCAPTCHA（v3）

---

 ディレクトリ構成（抜粋）

├── app/
│ ├── Http/
│ └── Models/
├── database/
│ └── migrations/
├── public/
│ └── storage/ → storage:linkによる公開画像
├── resources/
│ ├── css/
│ ├── js/
│ │ └── components/ → Vueコンポーネント
│ ├── views/
│ │ └── admin/ / products/ / mypage/ など
├── routes/
│ ├── web.php
│ └── api.php
├── storage/
│ └── app/
│ └── public/
│ ├── images/ → 本画像
│ └── temp/ → 一時画像
├── .env.example
├── composer.json
└── vite.config.js


---

　
【一般ユーザー向け】
ログイン（PASS認証、パスワード再設定）
ログアウト
新規ユーザー登録
マイページ（編集 / 退会 / お気に入り / 購入履歴）
商品一覧（詳細 / 検索〔カテゴリー / キーワード〕 / お気に入り登録）
ECカート（数量変更 / サイズ変更 / 削除 / Stripe決済）
お問い合わせフォーム

【管理者向け】
ログイン（PASS認証、パスワード再設定）
ログアウト
ユーザー管理（一覧 / 登録 / 編集 / 削除 / CSVダウンロード）
商品管理（一覧 / 詳細 / 登録 / 編集 / 削除 / CSVダウンロード）
売上管理（日別 / 週別 / 月別 / ソート機能 / CSVダウンロード）
問い合わせ管理（一覧 / 詳細 / 返信）

【共通】
レスポンシブ対応
ページネーション
リキャプチャ
スライダー
モーダルウィンドウ



 補足事項
商品画像は public/img/productsと/sub に保存され、確認画面では storage/app/public/temp/ を使用

メール機能は .env に応じて log ドライバで動作（MailhogやSMTPも可）

Vueは商品一覧・お気に入り登録・検索に使用し、他はBladeで構築



### `users（会員）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ユーザーID |
| email | VARCHAR(255) | NOT NULL | メールアドレス |
| email_verified_at | TIMESTAMP | NULL | メール確認日時 |
| password | VARCHAR(255) | NOT NULL | ハッシュパスワード |
| remember_token | VARCHAR(100) | NULL | リメンバートークン |
| family_name | VARCHAR(255) | NOT NULL | 姓 |
| first_name | VARCHAR(255) | NOT NULL | 名 |
| family_name_kana | VARCHAR(255) | NOT NULL | セイ |
| first_name_kana | VARCHAR(255) | NOT NULL | メイ |
| sex | TINYINT(4) | NOT NULL | 性別 |
| year | VARCHAR(4) | NOT NULL | 生年 |
| month | VARCHAR(2) | NOT NULL | 生月 |
| day | VARCHAR(2) | NOT NULL | 生日 |
| zip1 | VARCHAR(255) | NOT NULL | 郵便番号(前) |
| zip2 | VARCHAR(255) | NOT NULL | 郵便番号(後) |
| address | VARCHAR(255) | NOT NULL | 住所 |
| tel1 | VARCHAR(255) | NOT NULL | 電話番号1 |
| tel2 | VARCHAR(255) | NOT NULL | 電話番号2 |
| tel3 | VARCHAR(255) | NOT NULL | 電話番号3 |
| contents | TEXT | NULL | 備考 |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |
| deleted_at | TIMESTAMP | NULL | 退会日時（論理削除） |

---

### `admins（管理者）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | 管理者ID |
| name | VARCHAR(255) | NOT NULL | 氏名 |
| email | VARCHAR(255) | NOT NULL, UNIQUE | メールアドレス |
| email_verified_at | TIMESTAMP | NULL | メール確認日時 |
| password | VARCHAR(255) | NOT NULL | パスワード |
| remember_token | VARCHAR(100) | NULL | リメンバートークン |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `categories（カテゴリ）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | カテゴリID |
| name | VARCHAR(255) | NOT NULL | カテゴリ名 |
| parent_id | BIGINT | NULL | 親カテゴリID |
| sort_order | INT | DEFAULT 0 | 表示順 |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `products（商品）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | 商品ID |
| name | VARCHAR(255) | NOT NULL | 商品名 |
| detail | TEXT | NULL | 商品説明 |
| price | DECIMAL(10,3) | NOT NULL | 価格 |
| ctg_id | BIGINT | NOT NULL, FK → categories.id | カテゴリID |
| image | VARCHAR(255) | NULL | メイン画像パス |
| delete_flg | TINYINT(1) | DEFAULT 0 | 削除フラグ |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `product_images（商品スライダー画像）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| product_id | BIGINT | NOT NULL, FK → products.id | 商品ID |
| image_path | VARCHAR(255) | NOT NULL | 画像パス |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `carts（カート）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| user_id | BIGINT | NOT NULL, FK → users.id | ユーザーID |
| product_id | BIGINT | NOT NULL, FK → products.id | 商品ID |
| size | VARCHAR(10) | NULL | サイズ |
| num | TINYINT | NOT NULL DEFAULT 1 | 数量 |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |
| deleted_at | TIMESTAMP | NULL | 論理削除 |

---

### `orders（注文）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | 注文ID |
| user_id | BIGINT | NOT NULL, FK → users.id | ユーザーID |
| total_price | DECIMAL(10,2) | NOT NULL | 合計金額 |
| status | ENUM | 'pending', 'completed', 'canceled' | 注文ステータス |
| postcode | VARCHAR(255) | NULL | 郵便番号 |
| address | VARCHAR(255) | NULL | 住所 |
| tel | VARCHAR(255) | NULL | 電話番号 |
| created_at | TIMESTAMP | NULL | 注文日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `order_items（注文詳細）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| order_id | BIGINT | NOT NULL, FK → orders.id | 注文ID |
| product_id | BIGINT | NOT NULL, FK → products.id | 商品ID |
| quantity | INT | NOT NULL | 数量 |
| price | DECIMAL(10,2) | NOT NULL | 価格 |
| size | VARCHAR(10) | NULL | サイズ |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `favorites（お気に入り）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| user_id | BIGINT | NOT NULL, FK → users.id | ユーザーID |
| product_id | BIGINT | NOT NULL, FK → products.id | 商品ID |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `contacts（お問い合わせ）`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| name | VARCHAR(255) | NOT NULL | 名前 |
| email | VARCHAR(255) | NOT NULL | メールアドレス |
| content | TEXT | NOT NULL | 内容 |
| status | ENUM | 'pending', 'replied' | 対応ステータス |
| reply_message | TEXT | NULL | 返信内容 |
| replied_at | TIMESTAMP | NULL | 返信日時 |
| created_at | TIMESTAMP | NULL | 登録日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---

### `password_resets`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| email | VARCHAR(255) | PK | メールアドレス |
| token | VARCHAR(255) | NOT NULL | トークン |
| created_at | TIMESTAMP | NULL | 作成日時 |

---

### `password_reset_tokens`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| email | VARCHAR(255) | PK | メールアドレス |
| token | VARCHAR(255) | NOT NULL | トークン |
| created_at | TIMESTAMP | NULL | 作成日時 |

---

### `failed_jobs`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| uuid | VARCHAR(255) | NOT NULL | UUID |
| connection | TEXT | NOT NULL | 接続名 |
| queue | TEXT | NOT NULL | キュー名 |
| payload | LONGTEXT | NOT NULL | 内容 |
| exception | LONGTEXT | NOT NULL | 例外情報 |
| failed_at | TIMESTAMP | DEFAULT current_timestamp | 失敗日時 |

---

### `migrations`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | INT | PK, AUTO_INCREMENT | ID |
| migration | VARCHAR(255) | NOT NULL | マイグレーション名 |
| batch | INT | NOT NULL | バッチ番号 |

---

### `personal_access_tokens`

| カラム名 | 型 | 属性 | 説明 |
|----------|----|------|------|
| id | BIGINT | PK, AUTO_INCREMENT | ID |
| tokenable_type | VARCHAR(255) | NOT NULL | モデルタイプ |
| tokenable_id | BIGINT | NOT NULL | モデルID |
| name | VARCHAR(255) | NOT NULL | トークン名 |
| token | VARCHAR(64) | NOT NULL | トークン |
| abilities | TEXT | NULL | 権限 |
| last_used_at | TIMESTAMP | NULL | 最終使用日時 |
| expires_at | TIMESTAMP | NULL | 有効期限 |
| created_at | TIMESTAMP | NULL | 作成日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

---
