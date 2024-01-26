<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDetailTimesTable extends Migration
{
  public function up()
  {
    Schema::create('lectureDetailTimes', function (Blueprint $table) {
      $table->id('lectureDetailTimeId'); // 自動増分の主キー
      $table->unsignedBigInteger('lectureDetailId');
      $table->foreign('lectureDetailId')->references('lectureDetailId')->on('lectureDetails')->onDelete('cascade');
      $table->integer('year');
      $table->string('term');
      $table->string('dayOfWeek');
      $table->string('timePeriod');

      // 短い一意性制約名を使用
      // $table->unique(['lectureDetailId', 'term', 'dayOfWeek', 'timePeriod'], 'lecture_detail_times_unique');
    });
  }

  public function down()
  {
    Schema::dropIfExists('lectureDetailTimes');
  }
};
