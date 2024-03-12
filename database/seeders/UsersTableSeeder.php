<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        $user = DB::table('users')->insertGetId([
          'userName' => 'intmain1',
          'userEmail' => 'intmain1@com',
          'password' => Hash::make('intmain1@com'),
          'universityName' => '広島大学',
          'category' => '学部',
          'faculty' => '情報科学部',
          'department' => '情報科学科',
          'admissionYear' => "2023",
      ]);

    $user2 = DB::table('users')->insertGetId([
        'userName' => 'intmain3',
        'userEmail' => 'intmain3@com',
        'password' => Hash::make('intmain3@com'),
        'universityName' => '広島大学',
        'category' => '学部',
        'faculty' => '工学部',
        'department' => '第三類',
        'admissionYear' => "2022",
    ]);

    $user3 = DB::table('users')->insertGetId([
        'userName' => 'intmain6',
        'userEmail' => 'intmain6@com',
        'password' => Hash::make('intmain6@com'),
        'universityName' => '広島大学',
        'category' => '学部',
        'faculty' => '教育学部',
        'department' => '教育学科',
        'admissionYear' => "2021",
    ]);

    if ($user) {
        // ユーザーにロールを割り当て
        $adminRole = Role::create(['name' => 'admin']);

        // 権限作成
        $adminPermission = Permission::create(['name' => 'admin']);

        // ユーザーに権限を付与
        $userModel = \App\Models\User::find($user);
        $userModel->assignRole('admin');
        $userModel->givePermissionTo('admin');

    }

    if ($user2) {
        // ユーザーにロールを割り当て
        $adminRole = Role::create(['name' => 'user']);

        // 権限作成
        $adminPermission = Permission::create(['name' => 'user']);

        // ユーザーに権限を付与
        $userModel2 = \App\Models\User::find($user2);
        $userModel2->assignRole('user');
        $userModel2->givePermissionTo('user');
    }

    if ($user3) {

        // ユーザーに権限を付与
        $userModel3 = \App\Models\User::find($user3);
        $userModel3->assignRole('user');
        $userModel3->givePermissionTo('user');
    }

        $csvFile = database_path('csv/users.csv');
        $handle = fopen($csvFile, 'r');

        if ($handle !== FALSE) {
            fgetcsv($handle); // CSVのヘッダー行をスキップ

            while (($data = fgetcsv($handle)) !== FALSE) {
                $validator = Validator::make([
                    'userName' => $data[1],
                    'userEmail' => $data[2],
                    'password' => $data[3],
                    'universityName' => $data[4],
                    'category' => $data[5],
                    'faculty' => $data[6],
                    'department' => $data[7],
                    'admissionYear' => $data[8],
                ], [
                    'userName' => 'required|string',
                    'userEmail' => 'required|email',
                    'password' => 'required|string|min:8',
                    'universityName' => 'required|string',
                    'category' => 'required|string',
                    'faculty' => 'required|string',
                    'department' => 'required|string',
                    'admissionYear' => 'required|integer',
                ]);

                if ($validator->fails()) {
                    Log::error('バリデーションエラー', [
                        'errors' => $validator->errors()
                    ]);
                    continue;
                }

                $user = DB::table('users')->insertGetId([
                    'userName' => $data[1],
                    'userEmail' => $data[2],
                    'password' => Hash::make($data[3]),
                    'universityName' => $data[4],
                    'category' => $data[5],
                    'faculty' => $data[6],
                    'department' => $data[7],
                    'admissionYear' => $data[8],
                ]);

                // ユーザーモデルを取得
                $userModel = \App\Models\User::find($user);
                if ($userModel) {

                    $adminRole = Role::firstOrCreate(['name' => 'user']);

                    // 権限作成
                    $adminPermission = Permission::firstOrCreate(['name' => 'user']);

                    $userModel = \App\Models\User::find($user);
                    $userModel->assignRole('user');
                    $userModel->givePermissionTo('user');
                }
            }

            fclose($handle);
        } else {
            Log::error('CSVファイルを開けませんでした。', [
                'path' => $csvFile
            ]);
        }
    }
}