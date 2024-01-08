<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureLabelsTable extends Migration
{
    public function up()
    {
        Schema::create('lecture_labels', function (Blueprint $table) {
            $table->unsignedBigInteger('lecture_id');
            $table->unsignedBigInteger('label_id');
            
            // 外部キー制約を追加
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures')->onDelete('cascade');
            $table->foreign('label_id')->references('label_id')->on('labels')->onDelete('cascade');

            $table->primary(['lecture_id', 'label_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecture_labels');
    }
};