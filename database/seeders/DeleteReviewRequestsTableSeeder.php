<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleteReviewRequestsTableSeeder extends Seeder
{
    public function run()
    {
        // レビュー削除リクエストデータの挿入
        DB::table('deleteReviewRequests')->insert([
            'reviewId' => 1,
            'userId' => 1,
            'createdAt' => now(),
        ]);

        DB::table('deleteReviewRequests')->insert([
            'reviewId' => 2,
            'userId' => 1,
            'createdAt' => now(),
        ]);

        DB::table('deleteReviewRequests')->insert([
            'reviewId' => 2,
            'userId' => 2,
            'createdAt' => now(),
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
