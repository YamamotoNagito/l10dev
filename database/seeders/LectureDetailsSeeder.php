<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureDetailsSeeder extends Seeder
{
    public function run()
    {
        // 講義詳細データの追加
        DB::table('lecture_details')->insert([
            'lecture_id' => 1,  // 適切な lecture_id を指定
            'lecture_code' => 'ABC123',
            'syllabus_url' => 'https://example.com/syllabus',
            'location' => '東広島',
            'faculty' => '情報科学部',
            'category' => 'プログラミング',
            'grade' => '1年生',
        ]);

        // 別の講義詳細データの追加
        DB::table('lecture_details')->insert([
            'lecture_id' => 2,  // 適切な lecture_id を指定
            'lecture_code' => 'XYZ456',
            'syllabus_url' => 'https://example.com/syllabus2',
            'location' => '霞キャンパス',
            'faculty' => '工学部',
            'category' => 'プログラミング',
            'grade' => '2年生',
        ]);
    }
}
