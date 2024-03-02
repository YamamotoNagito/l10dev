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
