<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesTable extends Migration
{
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id('lecture_id');
            $table->string('lecture_name');
            $table->string('teacher_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 修正: reviews テーブルが存在し、外部キー制約が正しいことを確認
            $table->dropForeign(['lecture_id']);
        });
        
        Schema::dropIfExists('lectures');
    }
};
