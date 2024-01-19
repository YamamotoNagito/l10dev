<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //講義データの追加
        DB::table('lectures')->insert([
            'lectureName' => 'プログラミング1',
            'teacherName' => '田中角栄',
        ]);

        DB::table('lectures')->insert([
            'lectureName' => 'プログラミング2',
            'teacherName' => '山本太郎',
        ]);

        DB::table('lectures')->insert([
            'lectureName' => '一攫千金特論',
            'teacherName' => '服部はん',
        ]);

        DB::table('lectures')->insert([
            'lectureName' => '機械学習特論',
            'teacherName' => '岩本幸美',
        ]);

    }
}
