<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 初期データの挿入
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

            // パーミッションを取得
            Log::Debug("userModel:");
            // Log::Debug($userModel);
            
            Log::Debug($userModel->getRoleNames());
            Log::Debug($userModel->getDirectPermissions());
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
            // $userModel->givePermissionTo('admin');

            // パーミッションを取得
            Log::Debug("userModel2:");
            // Log::Debug($userModel2);
            Log::Debug($userModel2->getRoleNames());
            Log::Debug($userModel2->getDirectPermissions());
        }
        
        if ($user3) {
            
            // ユーザーに権限を付与
            $userModel3 = \App\Models\User::find($user3);
            $userModel3->assignRole('user');
            $userModel3->givePermissionTo('user');
            // $userModel->givePermissionTo('admin');

            // パーミッションを取得
            Log::Debug("userModel3:");
            // Log::Debug($userModel2);
            Log::Debug($userModel3->getRoleNames());
            Log::Debug($userModel3->getDirectPermissions());
        }
    }
}
