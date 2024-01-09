<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->unsignedBigInteger('lecture_id');
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('attendance_year');
            $table->string('attendance_confirm');
            $table->string('weekly_assignments');
            $table->string('midterm_assignments');
            $table->string('final_assignments');
            $table->string('past_exam_possession');
            $table->string('grades');
            $table->integer('credit_level');
            $table->integer('interest_level');
            $table->integer('skill_level');
            $table->text('comments')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps(); // created_at と updated_at カラムの追加
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};