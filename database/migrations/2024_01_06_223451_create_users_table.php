<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary(); // UUID型の主キー
            $table->string('user_name');
            $table->string('email_address')->unique();
            $table->string('password');
            $table->string('university_name');
            $table->string('category');
            $table->string('faculty');
            $table->string('department');
            $table->integer('admission_year');
            $table->timestamp('created_at')->useCurrent(); // 投稿時間
            $table->timestamp('updated_at')->useCurrent(); // 更新時間
            $table->timestamp('last_login_at')->nullable(); // 最終ログイン（nullableはNULLを許可）

            // 他の必要なカラムや制約を追加
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};