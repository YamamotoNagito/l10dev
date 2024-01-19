<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureDetailsSeeder extends Seeder
{
    public function run()
    {
        // 講義詳細データの追加
        DB::table('lectureDetails')->insert([
            'lectureId' => 1,  // 適切な lectureId を指定
            'lectureCode' => 'ABC123',
            'syllabusUrl' => 'https://example.com/syllabus',
            'location' => '東広島',
            'faculty' => '情報科学部',
            'category' => 'プログラミング',
            'grade' => '1年生',
        ]);

        // 別の講義詳細データの追加
        DB::table('lectureDetails')->insert([
            'lectureId' => 2,  // 適切な lectureId を指定
            'lectureCode' => 'XYZ456',
            'syllabusUrl' => 'https://example.com/syllabus2',
            'location' => '霞キャンパス',
            'faculty' => '工学部',
            'category' => 'プログラミング',
            'grade' => '2年生',
        ]);
    }
}
