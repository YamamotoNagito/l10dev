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
            'reviewId' => 1,
            'userId' => 1,
            'createdAt' => now(),
        ]);

        DB::table('likes')->insert([
            'reviewId' => 1,
            'userId' => 2,
            'createdAt' => now(),
        ]);

        DB::table('likes')->insert([
            'reviewId' => 2,
            'userId' => 2,
            'createdAt' => now(),
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
