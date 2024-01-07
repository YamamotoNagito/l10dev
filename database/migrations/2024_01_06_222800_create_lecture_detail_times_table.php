<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDetailTimesTable extends Migration
{
    public function up()
    {
        Schema::create('lecture_detail_times', function (Blueprint $table) {
            $table->increments('lecture_time_id'); // 自動増分の主キー
            $table->uuid('lecture_detail_id');
            $table->foreign('lecture_detail_id')->references('lecture_detail_id')->on('lecture_details')->onDelete('cascade');
            $table->string('lecture_term');
            $table->string('lecture_day_of_week');
            $table->string('lecture_time_period');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecture_detail_times');
    }
};