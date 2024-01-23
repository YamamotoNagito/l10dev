<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDetailTimesTable extends Migration
{
    public function up()
    {
        Schema::create('lectureDetailTimes', function (Blueprint $table) {
            $table->id('lectureTimeId'); // 自動増分の主キー
            $table->unsignedBigInteger('lectureDetailId');
            $table->foreign('lectureDetailId')->references('lectureDetailId')->on('lectureDetails')->onDelete('cascade');
            $table->integer('year');
            $table->string('term');
            $table->string('dayOfWeek');
            $table->string('timePeriod');

            // $table->unique(['term', 'dayOfWeek', 'timePeriod']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lectureDetailTimes');
    }
};