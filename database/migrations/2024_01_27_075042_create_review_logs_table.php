<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewLogsTable extends Migration
{
    public function up()
    {
        Schema::create('reviewLogs', function (Blueprint $table) {
            $table->id('reviewLogId');
            $table->unsignedBigInteger('lectureId');
            $table->foreign('lectureId')->references('lectureId')->on('lectures'); //->onDelete('cascade');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
            $table->integer('attendanceYear');
            $table->string('attendanceConfirm');
            $table->string('weeklyAssignments');
            $table->string('midtermAssignments');
            $table->string('finalAssignments');
            $table->string('pastExamPossession');
            $table->string('grades');
            $table->integer('creditLevel');
            $table->integer('interestLevel');
            $table->integer('skillLevel');
            $table->text('comments',2048)->nullable();
            $table->string('status');
            $table->timestamp('createdAt')->default(now()); // createdAt(作成日時)
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviewLogs');
    }
};
