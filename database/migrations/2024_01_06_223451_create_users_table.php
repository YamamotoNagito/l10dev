<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('user_name');
            $table->string('email_adress')->unique();
            $table->string('password');
            $table->string('user_university_name');
            $table->string('user_category');
            $table->string('user_faculty');
            $table->string('user_department');
            $table->string('user_admission_year');
            $table->rememberToken();
            $table->timestamps();
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