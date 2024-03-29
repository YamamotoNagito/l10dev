<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewLogsTableSeeder extends Seeder
{
    public function run()
    {
        // レビューデータの挿入
        DB::table('reviewLogs')->insert([
            'lectureId' => 1,
            'userId' => 1,
            'attendanceYear' => 2022,
            'attendanceConfirm' => '出席あり',
            'weeklyAssignments' => '良い',
            'midtermAssignments' => '普通',
            'finalAssignments' => '良い',
            'pastExamPossession' => 'あり',
            'grades' => 'A',
            'creditLevel' => 3,
            'interestLevel' => 4,
            'skillLevel' => 5,
            'comments' => 'この講義は非常に面白かったです。',
            'status'=>'create',
            'createdAt' => now(),
        ]);

        DB::table('reviewLogs')->insert([
            'lectureId' => 1,
            'userId' => 2,
            'attendanceYear' => 2024,
            'attendanceConfirm' => '出席なし',
            'weeklyAssignments' => '良い',
            'midtermAssignments' => '普通',
            'finalAssignments' => '良い',
            'pastExamPossession' => 'あり',
            'grades' => '優',
            'creditLevel' => 4,
            'interestLevel' => 5,
            'skillLevel' => 1,
            'comments' => 'この講義は非常に面白かったです。',
            'status'=>'create',
            'createdAt' => now(),
        ]);

        // 別のレビューデータを挿入する場合は、適宜追加
        DB::table('reviewLogs')->insert([
            'lectureId' => 2,
            'userId' => 2,
            'attendanceYear' => 2023,
            'attendanceConfirm' => '出席なし',
            'weeklyAssignments' => '普通',
            'midtermAssignments' => '悪い',
            'finalAssignments' => '普通',
            'pastExamPossession' => 'なし',
            'grades' => '秀',
            'creditLevel' => 2,
            'interestLevel' => 3,
            'skillLevel' => 4,
            'comments' => '特に印象に残る講義ではありませんでした。',
            'status'=>'create',
            'createdAt' => now(),
        ]);

        // 別のレビューデータを挿入する場合は、適宜追加
        DB::table('reviewLogs')->insert([
            'lectureId' => 1,
            'userId' => 3,
            'attendanceYear' => 2023,
            'attendanceConfirm' => '出席なし',
            'weeklyAssignments' => '普通',
            'midtermAssignments' => '悪い',
            'finalAssignments' => '普通',
            'pastExamPossession' => 'なし',
            'grades' => '秀',
            'creditLevel' => 2,
            'interestLevel' => 3,
            'skillLevel' => 4,
            'comments' => '特に印象に残る講義ではありませんでした。',
            'status'=>'create',
            'createdAt' => now(),
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
