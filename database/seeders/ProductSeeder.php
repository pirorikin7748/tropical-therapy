<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->updateOrInsert([
            [
              'name' => 'メンズステンカラーコート(ベージュ)',
              'detail' => 'シンプルながらも洗練されたデザインのステンカラーコート。
軽量で動きやすく、スーツやカジュアルにも合わせやすい万能アウターです。
春先や秋口にも活躍する、季節の変わり目にぴったりな一枚。
・裏地なしの軽やか設計

・ビジネスにも休日にも◎

・丈は膝上のスタイリッシュな長さ',
              'price' => 12000,
              'ctg_id' => '3',
              'image' => 'coat_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズステンカラーコート(ネイビー)',
              'detail' => 'シンプルながらも洗練されたデザインのステンカラーコート。
軽量で動きやすく、スーツやカジュアルにも合わせやすい万能アウターです。
春先や秋口にも活躍する、季節の変わり目にぴったりな一枚。
・裏地なしの軽やか設計

・ビジネスにも休日にも◎

・丈は膝上のスタイリッシュな長さ',
              'price' => 12000,
              'ctg_id' => '3',
              'image' => 'coat_navy.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズステンカラーコート(ブラック)',
              'detail' => 'シンプルながらも洗練されたデザインのステンカラーコート。
軽量で動きやすく、スーツやカジュアルにも合わせやすい万能アウターです。
春先や秋口にも活躍する、季節の変わり目にぴったりな一枚。
・裏地なしの軽やか設計

・ビジネスにも休日にも◎

・丈は膝上のスタイリッシュな長さ',
              'price' => 12000,
              'ctg_id' => '3',
              'image' => 'coat_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパーカー(ベージュ)	',
              'detail' => 'リラックス感がありながらも品よく着こなせる、定番プルオーバーパーカー。
裏毛素材で通年使いやすく、ジーンズやスラックスにも相性抜群。
大きめのフードがさりげなく小顔効果も◎
・ややゆったりめのリラックスシルエット

・カンガルーポケット付き

・袖リブで風を通しにくい設計',
              'price' => 9000,
              'ctg_id' => '4',
              'image' => 'hoodie_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパーカー(ホワイト)',
              'detail' => 'リラックス感がありながらも品よく着こなせる、定番プルオーバーパーカー。
裏毛素材で通年使いやすく、ジーンズやスラックスにも相性抜群。
大きめのフードがさりげなく小顔効果も◎
・ややゆったりめのリラックスシルエット

・カンガルーポケット付き

・袖リブで風を通しにくい設計',
              'price' => 9000,
              'ctg_id' => '4',
              'image' => 'hoodie_white.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパーカー(ネイビー)',
              'detail' => 'リラックス感がありながらも品よく着こなせる、定番プルオーバーパーカー。
裏毛素材で通年使いやすく、ジーンズやスラックスにも相性抜群。
大きめのフードがさりげなく小顔効果も◎
・ややゆったりめのリラックスシルエット

・カンガルーポケット付き

・袖リブで風を通しにくい設計',
              'price' => 9000,
              'ctg_id' => '4',
              'image' => 'hoodie_nevy.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパーカー(ブラック)',
              'detail' => 'リラックス感がありながらも品よく着こなせる、定番プルオーバーパーカー。
裏毛素材で通年使いやすく、ジーンズやスラックスにも相性抜群。
大きめのフードがさりげなく小顔効果も◎
・ややゆったりめのリラックスシルエット

・カンガルーポケット付き

・袖リブで風を通しにくい設計',
              'price' => 9000,
              'ctg_id' => '4',
              'image' => 'hoodie_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズTシャツ(ベージュ)',
              'detail' => '一枚でサマになる、程よく厚手のプレミアムTシャツ。
クルーネック＆ややゆったりめのシルエットで、大人の余裕を感じさせる一枚。
着心地はソフトなのに型崩れしにくく、長く愛用できます。
・上質コットン100%使用

・肌触りやわらか＆しっかり素材

・一枚でもインナーでも使える万能T',
              'price' => 6000,
              'ctg_id' => '6',
              'image' => 'T-shirt_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズTシャツ(ホワイト)',
              'detail' => '一枚でサマになる、程よく厚手のプレミアムTシャツ。
クルーネック＆ややゆったりめのシルエットで、大人の余裕を感じさせる一枚。
着心地はソフトなのに型崩れしにくく、長く愛用できます。
・上質コットン100%使用

・肌触りやわらか＆しっかり素材

・一枚でもインナーでも使える万能T',
              'price' => 6000,
              'ctg_id' => '6',
              'image' => 'T-shirt_white.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズTシャツ(ブラック)',
              'detail' => '一枚でサマになる、程よく厚手のプレミアムTシャツ。
クルーネック＆ややゆったりめのシルエットで、大人の余裕を感じさせる一枚。
着心地はソフトなのに型崩れしにくく、長く愛用できます。
・上質コットン100%使用

・肌触りやわらか＆しっかり素材

・一枚でもインナーでも使える万能T',
              'price' => 6000,
              'ctg_id' => '6',
              'image' => 'tshirt_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパンツ(ベージュ)',
              'detail' => 'テーパードシルエットが美しい、洗練された大人のスラックス。
ウエストはイージー仕様でストレスフリーながら、きちんと見えする一本。
シンプルで合わせやすく、オンオフ問わず大活躍します。
・ウエストゴム＋ドローコード付き

・落ち感のある上品な素材

・自宅で洗えるウォッシャブル仕様',
              'price' => 7500,
              'ctg_id' => '7',
              'image' => 'pants_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパンツ(ネイビー)',
              'detail' => 'テーパードシルエットが美しい、洗練された大人のスラックス。
ウエストはイージー仕様でストレスフリーながら、きちんと見えする一本。
シンプルで合わせやすく、オンオフ問わず大活躍します。
・ウエストゴム＋ドローコード付き

・落ち感のある上品な素材

・自宅で洗えるウォッシャブル仕様',
              'price' => 7500,
              'ctg_id' => '7',
              'image' => 'pants_nevy.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズパンツ(ブラック)',
              'detail' => 'テーパードシルエットが美しい、洗練された大人のスラックス。
ウエストはイージー仕様でストレスフリーながら、きちんと見えする一本。
シンプルで合わせやすく、オンオフ問わず大活躍します。
・ウエストゴム＋ドローコード付き

・落ち感のある上品な素材

・自宅で洗えるウォッシャブル仕様',
              'price' => 7500,
              'ctg_id' => '7',
              'image' => 'pants_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズデニムパンツ',
              'detail' => 'どんなトップスにも合う、定番のストレートデニム。
ほんのりテーパードがかったシルエットで、ラフすぎず上品な印象に。
経年変化も楽しめる素材で、長く付き合える一本です。
・オールシーズン対応

・ストレッチ性ありで動きやすい

・フロントはジップフライ仕様',
              'price' => 8500,
              'ctg_id' => '7',
              'image' => 'pants_denim.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースチェスターコート(カーキ)',
              'detail' => 'こなれ感のあるカーキカラーで、スタイリングのアクセントになるチェスターコート。シンプルなデザインだからこそカラーが引き立ち、大人のカジュアルスタイルにおすすめです。',
              'price' => 13000,
              'ctg_id' => '8',
              'image' => 'redieschestercoat_khaki.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースチェスターコート(ブラック)',
              'detail' => 'シンプルでスタイリッシュなブラックのチェスターコート。無駄のないデザインで、どんなコーディネートにも合わせやすく、羽織るだけで品格をプラスします。オフィスシーンからプライベートまで幅広く活躍。',
              'price' => 13000,
              'ctg_id' => '8',
              'image' => 'redieschestercoat_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースチェスターコート(ベージュ)',
              'detail' => 'やわらかなベージュカラーが優しい雰囲気を演出するチェスターコート。重くなりがちな秋冬コーデも軽やかに仕上がります。きれいめにもカジュアルにもマッチする万能アウターです。',
              'price' => 13000,
              'ctg_id' => '8',
              'image' => 'redieschestercoat_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースワンピース(カーキ)',
              'detail' => 'トレンド感のあるカーキカラーで、こなれた印象を演出するノースリーブワンピース。程よいフィット感とナチュラルな風合いが大人の余裕を感じさせます。シンプルながら着映えする一着です。',
              'price' => 7500,
              'ctg_id' => '9',
              'image' => 'rediesdress_khaki.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースワンピース(ブラック)',
              'detail' => 'シンプルで洗練されたデザインのノースリーブワンピース。軽やかな素材感で、カジュアルからきれいめまで幅広く使えます。ブラックカラーが大人っぽさと引き締め効果を演出。アクセサリーや羽織りで季節感も自由自在に楽しめます。',
              'price' => 7500,
              'ctg_id' => '9',
              'image' => 'rediesdress_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースワンピース(ベージュ)',
              'detail' => '柔らかなグレージュカラーが上品な印象を与えるノースリーブワンピース。優しいニュアンスカラーで肌なじみが良く、女性らしい柔らかさを引き立てます。オンにもオフにも使える万能アイテムです。',
              'price' => 7500,
              'ctg_id' => '9',
              'image' => 'rediesdress_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースニットセーター(ベージュ)',
              'detail' => 'ベージュの柔らかい色味が魅力のニット。ふんわりとした質感で肌触りも良く、リラックスした着心地です。シンプルなデザインでコーディネートの幅が広がり、デイリーに使いやすい一枚です。',
              'price' => 7000,
              'ctg_id' => '11',
              'image' => 'rediesknitwear_baige.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディーススキニーパンツ(ブラック)',
              'detail' => 'すっきりとしたシルエットが美しいブラックのスキニーパンツ。脚をきれいに見せてくれるラインで、トップスを選ばず着回し力抜群。カジュアルにもきれいめにも活躍する万能ボトムです。',
              'price' => 7500,
              'ctg_id' => '12',
              'image' => 'redies_skinny_black.png',
              'created_at' => now(),
            ],
            [
              'name' => 'レディースデニムパンツ',
              'detail' => 'シンプルで大人っぽいインディゴブルーのデニムパンツ。程よくフィットするシルエットで美脚効果も◎。カジュアルコーデはもちろん、きれいめトップスと合わせた大人カジュアルにもおすすめです。',
              'price' => 8500,
              'ctg_id' => '12',
              'image' => 'redies_denimpants.png',
              'created_at' => now(),
            ],
            [
              'name' => 'メンズブラックレザーライダースジャケット',
              'detail' => '上質な本革を贅沢に使用した、シンプルで洗練された大人のためのライダースジャケット。
ほどよく体にフィットするスマートなシルエットは、着るだけでスタイルを引き締め、都会的な印象を演出します。',
              'price' => 45000,
              'ctg_id' => '3',
              'image' => 'img_680069569d6114.70044170-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'ストライプ柄ブルーブラウス',
              'detail' => '爽やかなブルーのストライプが印象的な、大人の女性のための上品なブラウス。
柔らかな質感の素材を使用し、着心地は軽やかで通気性も抜群。
ゆったりとしたシルエットで体のラインを拾いすぎず、オンでもオフでも使える万能アイテムです。',
              'price' => 4500,
              'ctg_id' => '10',
              'image' => 'img_6809f4227608c9.21044317-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'リブニット クルーネックトップス（ベージュ）',
              'detail' => 'シンプルで洗練された印象を与える、ベージュカラーのリブ編みクルーネックニットトップス。
ほどよくフィットするシルエットが女性らしいラインを引き立て、柔らかく伸縮性のある素材で着心地も抜群。
一枚での着用はもちろん、ジャケットやアウターとのレイヤードにも最適で、ロングシーズン活躍する万能アイテムです。',
              'price' => 4300,
              'ctg_id' => '11',
              'image' => 'img_680b975792c140.23432910-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'エレガントベージュブラウス',
              'detail' => 'シンプルで洗練されたデザインが魅力のエレガントベージュブラウス。
とろみのある上質な素材を使用し、着心地も軽やか。
開きすぎないVネックラインとシャープな襟元が、顔まわりをすっきり見せ、大人の女性らしい上品さを演出します。
ボディラインを拾いすぎない絶妙なシルエットで、オフィススタイルからカジュアルコーデまで幅広く活躍。',
              'price' => 5300,
              'ctg_id' => '10',
              'image' => 'img_680e4084f2b2e9.89546222-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'シンプルデニムシャツ（ライトブルー）',
              'detail' => '上質なコットンデニムを使用した、スタイリッシュで大人っぽい印象のデニムシャツ。
ライトブルーの色味は爽やかで、カジュアルにもきれいめにも着こなせます。
一枚で着ても、Tシャツの上から羽織っても様になり、ロングシーズン活躍する万能アイテム。
すっきりとしたシルエットで、ジャケットインにもおすすめです。',
              'price' => 9900,
              'ctg_id' => '5',
              'image' => 'img_680e42e4934f59.37739666-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'レディース ストレートカーゴパンツ（オリーブグリーン）',
              'detail' => 'シンプルながら洗練されたデザインのカーゴパンツです。
やや細身のストレートシルエットで、カジュアルになりすぎず、きれいめにも着こなせる一着。
伸縮性のあるソフトなコットンブレンド素材を使用し、動きやすさと快適な履き心地を両立しました。
サイドポケット付きで実用性も抜群。Tシャツやブラウスはもちろん、ジャケットと合わせたきれいめスタイルにも対応できます。',
              'price' => 9800,
              'ctg_id' => '12',
              'image' => 'img_680ecfddc03107.09874389-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'ヴィンテージウォッシュ デニムジャケット',
              'detail' => 'カジュアルな中にも大人の余裕を感じさせる、ヴィンテージウォッシュ加工を施したデニムジャケット。ほどよいダメージ感がこなれた印象を与え、着るだけで洗練されたスタイリングに。タフな素材感ながら軽やかな着心地で、インナーを選ばずロングシーズン活躍します。
シンプルなカットと絶妙なブルーの色味が、どんなボトムスとも相性抜群。休日のリラックススタイルから、ジャケット代わりのライトアウター使いまで、幅広くコーディネート可能です。',
              'price' => 4800,
              'ctg_id' => '3',
              'image' => 'img_680ed89a2953d9.33106788-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'エレガントロングダウンコート（ベージュ）',
              'detail' => '寒い季節でもスタイリッシュに。
ミディアムトーンのベージュカラーが上品な印象を与えるロングダウンコート。軽量でありながら高い保温性を誇り、ふっくらとした中綿構造が冷たい風をしっかりブロック。シルエットは細身に設計されており、着膨れせず、女性らしいラインを引き立てます。',
              'price' => 19800,
              'ctg_id' => '8',
              'image' => 'img_68185289039c00.36462392-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'エアリーダウン ショートジャケット（ブラック）',
              'detail' => '軽やかさと暖かさを兼ね備えたショート丈のダウンジャケット。
コンパクトなシルエットながら、優れた保温性で冬の外出を快適にサポートします。
撥水加工を施した表地は、急な天候の変化にも対応可能。
都会的なブラックカラーは、どんなスタイルにも馴染みやすく、通勤・カジュアル問わず活躍する万能アウターです。',
              'price' => 13800,
              'ctg_id' => '8',
              'image' => 'img_6818540055b498.42392286-png',
              'created_at' => now(),
            ],
            [
              'name' => 'エレガンスブラック・Vネックブラウス',
              'detail' => '洗練されたシルエットと深めのVネックが魅力のブラックブラウス。
上品な光沢感のある生地は、フォーマルにもカジュアルにも合わせやすく、大人の女性のスタイルを格上げします。
一枚で着ても、ジャケットのインナーとしても美しく映える万能アイテム。オフィス、会食、デートなど、様々なシーンで活躍します。',
              'price' => 6980,
              'ctg_id' => '10',
              'image' => 'img_681855c564cb07.92333779-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'クラッシュスリムデニム（レディース）',
              'detail' => 'ヴィンテージ感漂うダメージ加工が魅力のスリムデニム。
程よいクラッシュデザインで、ラフさとこなれ感を演出。
脚のラインを綺麗に見せるスリムフィットで、カジュアルにもキレイめにもコーディネート可能。
Tシャツやシャツ、ニットとも相性が良く、オールシーズン活躍する一本です。',
              'price' => 8490,
              'ctg_id' => '12',
              'image' => 'img_681856efda8fe8.74178732-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'エッセンシャルクルーネックニット - ブラック',
              'detail' => 'シンプルで洗練されたデザインが魅力のクルーネックニット。柔らかな肌触りと程よいフィット感で、着心地抜群。オンにもオフにも対応する万能アイテムです。パンツにもスカートにも合わせやすく、秋冬のワードローブに欠かせない一枚。首元・裾・袖口はリブ仕様で上品に仕上げました。',
              'price' => 7980,
              'ctg_id' => '11',
              'image' => 'img_6818589f8eb301.07140249-jpg',
              'created_at' => now(),
            ],
            [
              'name' => 'エレガントクラシックトレンチコート（ネイビー）',
              'detail' => '洗練された大人の女性にぴったりのネイビートレンチコート。軽やかな生地感とすっきりとしたシルエットで、秋冬のスタイリングに品格をプラス。ウエストベルト付きでシーンに応じてフォルム調整ができ、ビジネスにもカジュアルにも活躍します。上品でタイムレスな一着です。',
              'price' => 15800,
              'ctg_id' => '8',
              'image' => 'img_68185e369737c6.31835833-jpg',
              'created_at' => now(),
            ],
        ]);
    }
}
