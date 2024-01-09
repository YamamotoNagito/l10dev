<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // 通常の自動増分の主キー
            $table->string('user_name',32);
            $table->string('user_email')->unique();
            $table->string('password');
            $table->string('university_name')->default("広島大学");
            $table->string('category');
            $table->string('faculty');
            $table->string('department');
            $table->integer('admission_year');
            $table->boolean('is_active')->default(true);
            $table->timestamps(); // created_at(ユーザー作成日時)とupdated_at(最終ログイン日時)はtimestampsが担う,
            $table->timestamp('last_login_at')->default(now());

            // 他の必要なカラムや制約を追加
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->timestamps();

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};