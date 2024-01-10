<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    public function run()
    {
        // レビューに対する「いいね」データの挿入
        DB::table('likes')->insert([
            'review_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('likes')->insert([
            'review_id' => 1,
            'user_id' => 2,
            'created_at' => now(),
        ]);

        DB::table('likes')->insert([
            'review_id' => 2,
            'user_id' => 2,
            'created_at' => now(),
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
