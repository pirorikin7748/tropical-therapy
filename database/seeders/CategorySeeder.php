<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //全削除
        DB::table('categories')->truncate();

        //親カテゴリ
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'メンズ', 'parent_id' => null, 'sort_order' => 1],
            ['id' => 2, 'name' => 'レディース', 'parent_id' => null, 'sort_order' => 2],
        ]);

        //子カテゴリ(メンズ)
        DB::table('categories')->insert([
            ['id' => 3, 'name' => 'ジャケット', 'parent_id' => 1, 'sort_order' => 1],
            ['id' => 4, 'name' => 'パーカー', 'parent_id' => 1, 'sort_order' => 2],
            ['id' => 5, 'name' => 'シャツ', 'parent_id' => 1, 'sort_order' => 3],
            ['id' => 6, 'name' => 'Tシャツ', 'parent_id' => 1, 'sort_order' => 4],
            ['id' => 7, 'name' => 'パンツ', 'parent_id' => 1, 'sort_order' => 5],
        ]);

        //子カテゴリ(レディース)
        DB::table('categories')->insert([
            ['id' => 8, 'name' => 'コート', 'parent_id' => 2, 'sort_order' => 1],
            ['id' => 9, 'name' => 'ワンピース', 'parent_id' => 2, 'sort_order' => 2],
            ['id' => 10, 'name' => 'ブラウス', 'parent_id' => 2, 'sort_order' => 3],
            ['id' => 11, 'name' => 'ニット', 'parent_id' => 2, 'sort_order' => 4],
            ['id' => 12, 'name' => 'パンツ', 'parent_id' => 2, 'sort_order' => 5],
        ]);
    }
}
