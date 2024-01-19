<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureLabelsTableSeeder extends Seeder
{
    public function run()
    {
        // ラベルと講義の対応付けを挿入する例
        DB::table('lectureLabels')->insert([
            'lectureId' => 1,
            'labelId' => 1,
        ]);
        
        DB::table('lectureLabels')->insert([
            'lectureId' => 1,
            'labelId' => 2,
        ]);

        DB::table('lectureLabels')->insert([
            'lectureId' => 2,
            'labelId' => 2,
        ]);

        DB::table('lectureLabels')->insert([
            'lectureId' => 2,
            'labelId' => 3,
        ]);

        // 他にも必要なデータがあれば同様に挿入
    }
}
