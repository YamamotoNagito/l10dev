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
            'label_name' => '数学',
        ]);

        DB::table('labels')->insert([
            'label_name' => '情報系',
        ]);

        DB::table('labels')->insert([
            'label_name' => '機械学習',
        ]);

        DB::table('labels')->insert([
            'label_name' => 'AI',
        ]);

        DB::table('labels')->insert([
            'label_name' => '子供',
        ]);

        DB::table('labels')->insert([
            'label_name' => '教員',
        ]);


    }
}
