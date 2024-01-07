<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            // $table->increments('review_id');
            $table->uuid('review_id')->primary();
            // $table->foreign('review_id')->references('review_id')->on('reviews')->onDelete('cascade');
            $table->uuid('lecture_id');
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures')->onDelete('cascade');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('attendance_year');
            $table->string('attendance_confirm');
            $table->string('weekly_assignments');
            $table->string('midterm_assignments');
            $table->string('final_assignments');
            $table->string('past_exam_possession');
            $table->string('grades');
            $table->string('credit_level');
            $table->string('interest_level');
            $table->string('skill_level');
            $table->text('comments');
            $table->timestamps(); // created_at と updated_at カラムの追加
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};