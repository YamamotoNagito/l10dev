<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('lectureDetails', function (Blueprint $table) {
            $table->id('lectureDetailId');
            $table->unsignedBigInteger('lectureId');
            $table->foreign('lectureId')->references('lectureId')->on('lectures')->onDelete('cascade');
            $table->string('lectureCode');
            $table->string('syllabusUrl');
            $table->string('location');
            $table->string('faculty');
            $table->string('category');
            $table->string('grade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lectureDetails');
    }
};