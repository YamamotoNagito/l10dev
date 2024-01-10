<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDetailTimesTable extends Migration
{
    public function up()
    {
        Schema::create('lecture_detail_times', function (Blueprint $table) {
            $table->id('lecture_time_id'); // 自動増分の主キー
            $table->unsignedBigInteger('lecture_detail_id');
            $table->foreign('lecture_detail_id')->references('lecture_detail_id')->on('lecture_details')->onDelete('cascade');
            $table->integer('year');
            $table->string('term');
            $table->string('day_of_week');
            $table->string('time_period');

            $table->unique(['term', 'day_of_week', 'time_period']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecture_detail_times');
    }
};