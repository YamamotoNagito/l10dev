<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('lecture_details', function (Blueprint $table) {
            $table->uuid('lecture_detail_id')->primary();
            $table->uuid('lecture_id');
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures')->onDelete('cascade');
            $table->string('lecture_code');
            $table->string('syllabus_url');
            $table->string('lecture_location');
            $table->string('lecture_faculty');
            $table->string('lecture_category');
            $table->string('lecture_grade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecture_details');
    }
};