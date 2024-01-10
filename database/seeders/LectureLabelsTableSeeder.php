<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureLabelsTableSeeder extends Seeder
{
    public function run()
    {
        // ラベルと講義の対応付けを挿入する例
        DB::table('lecture_labels')->insert([
            'lecture_id' => 1,
            'label_id' => 1,
        ]);
        
        DB::table('lecture_labels')->insert([
            'lecture_id' => 1,
            'label_id' => 2,
        ]);

        DB::table('lecture_labels')->insert([
            'lecture_id' => 2,
            'label_id' => 2,
        ]);

        DB::table('lecture_labels')->insert([
            'lecture_id' => 2,
            'label_id' => 3,
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
