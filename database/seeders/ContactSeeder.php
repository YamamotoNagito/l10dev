<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run()
    {
        DB::table('contact')->insert([
            'name' => '山田太郎',
            'email' => 'tarou@com',
            'category' => '削除依頼',
            'message' => '私の授業の悪口を削除してほしい',
            'created_at' => now(),
        ]);

        DB::table('contact')->insert([
            'name' => '斎藤次郎',
            'email' => 'jirou@com',
            'category' => '広告依頼',
            'message' => 'いいサイトだと思ったので広告を載せたい',
            'created_at' => now(),
        ]);

    }
}
