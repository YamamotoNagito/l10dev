<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelsTableSeeder extends Seeder
{
    public function run()
    {
        // ラベルデータの追加
        DB::table('labels')->insert([
            'labelName' => '数学',
        ]);

        DB::table('labels')->insert([
            'labelName' => '情報系',
        ]);

        DB::table('labels')->insert([
            'labelName' => '機械学習',
        ]);

        DB::table('labels')->insert([
            'labelName' => 'AI',
        ]);

        DB::table('labels')->insert([
            'labelName' => '子供',
        ]);

        DB::table('labels')->insert([
            'labelName' => '教員',
        ]);


    }
}
