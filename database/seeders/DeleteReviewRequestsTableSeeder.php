<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleteReviewRequestsTableSeeder extends Seeder
{
    public function run()
    {
        // レビュー削除リクエストデータの挿入
        DB::table('delete_review_requests')->insert([
            'review_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('delete_review_requests')->insert([
            'review_id' => 2,
            'user_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('delete_review_requests')->insert([
            'review_id' => 2,
            'user_id' => 2,
            'created_at' => now(),
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
