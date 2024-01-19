<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userId'); // 通常の自動増分の主キー
            $table->string('userName',32);
            $table->string('userEmail')->unique();
            $table->string('password');
            $table->string('universityName')->default("広島大学");
            $table->string('category');
            $table->string('faculty');
            $table->string('department');
            $table->integer('admissionYear');
            $table->boolean('isActive')->default(true);
            $table->timestamps('createdAt','updatedAt'); // createdAt(ユーザー作成日時)updatedAt(最終ログイン日時)はtimestampsが担う,
            $table->timestamp('lastLoginAt')->default(now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};