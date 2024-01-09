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
            'lecture_name' => 'プログラミング1',
            'teacher_name' => '田中角栄',
        ]);

        DB::table('lectures')->insert([
            'lecture_name' => 'プログラミング2',
            'teacher_name' => '山本太郎',
        ]);

        DB::table('lectures')->insert([
            'lecture_name' => '一攫千金特論',
            'teacher_name' => '服部はん',
        ]);

        DB::table('lectures')->insert([
            'lecture_name' => '機械学習特論',
            'teacher_name' => '岩本幸美',
        ]);

    }
}
