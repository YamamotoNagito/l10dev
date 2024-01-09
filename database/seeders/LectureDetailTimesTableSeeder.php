<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureDetailTimesTableSeeder extends Seeder
{
    public function run()
    {
        // レクチャー詳細タイムデータの追加
        DB::table('lecture_detail_times')->insert([
            'lecture_detail_id' => 1, // この値は lecture_details テーブルに存在する該当するレクチャー詳細のIDに置き換えてください
            'term' => '4ターム',
            'day_of_week' => '月曜日',
            'time_period' => '12限目',
        ]);

        DB::table('lecture_detail_times')->insert([
            'lecture_detail_id' => 2, // 同様に置き換え
            'term' => '3ターム',
            'day_of_week' => '水曜日',
            'time_period' => '34限',
        ]);

        // 他にも必要ならば追加
    }
}
