<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureDetailTimesTableSeeder extends Seeder
{
    public function run()
    {
        // レクチャー詳細タイムデータの追加
        DB::table('lectureDetailTimes')->insert([
            'lectureDetailId' => 1, // この値は lectureDetails テーブルに存在する該当するレクチャー詳細のIDに置き換えてください
            'year' => 2023,
            'term' => '4ターム',
            'dayOfWeek' => '月曜日',
            'timePeriod' => '12限',
        ]);

        DB::table('lectureDetailTimes')->insert([
            'lectureDetailId' => 2, // 同様に置き換え
            'year' => 2023,
            'term' => '3ターム',
            'dayOfWeek' => '水曜日',
            'timePeriod' => '34限',
        ]);

        // 他にも必要ならば追加
    }
}
