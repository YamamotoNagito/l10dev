<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // レビューデータの挿入
        DB::table('reviews')->insert([
            'lecture_id' => 1,
            'user_id' => 1,
            'attendance_year' => 2022,
            'attendance_confirm' => '出席あり',
            'weekly_assignments' => '良い',
            'midterm_assignments' => '普通',
            'final_assignments' => '良い',
            'past_exam_possession' => 'あり',
            'grades' => 'A',
            'credit_level' => 3,
            'interest_level' => 4,
            'skill_level' => 5,
            'comments' => 'この講義は非常に面白かったです。',
            'is_visible' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 別のレビューデータを挿入する場合は、適宜追加
        DB::table('reviews')->insert([
            'lecture_id' => 2,
            'user_id' => 2,
            'attendance_year' => 2023,
            'attendance_confirm' => '出席なし',
            'weekly_assignments' => '普通',
            'midterm_assignments' => '悪い',
            'final_assignments' => '普通',
            'past_exam_possession' => 'なし',
            'grades' => 'B',
            'credit_level' => 2,
            'interest_level' => 3,
            'skill_level' => 4,
            'comments' => '特に印象に残る講義ではありませんでした。',
            'is_visible' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
