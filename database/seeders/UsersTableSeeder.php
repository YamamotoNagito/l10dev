<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 初期データの挿入
        DB::table('users')->insert([
            'user_name' => 'intmain1@com',
            'user_email' => 'intmain1@com',
            'password' => Hash::make('intmain1@com'),
            'university_name' => '広島大学',
            'category' => '学部',
            'faculty' => '情報科学部',
            'department' => '情報科学科',
            'admission_year' => 2023,
        ]);

        DB::table('users')->insert([
            'user_name' => 'intmain3@com',
            'user_email' => 'intmain3@com',
            'password' => Hash::make('intmain3@com'),
            'university_name' => '広島大学',
            'category' => '学部',
            'faculty' => '工学部',
            'department' => '第三類',
            'admission_year' => 2022,
        ]);

        DB::table('users')->insert([
            'user_name' => 'intmain6@com',
            'user_email' => 'intmain6@com',
            'password' => Hash::make('intmain6@com'),
            'university_name' => '広島大学',
            'category' => '学部',
            'faculty' => '教育学部',
            'department' => '教育学科',
            'admission_year' => 2021,
        ]);
    }
}
