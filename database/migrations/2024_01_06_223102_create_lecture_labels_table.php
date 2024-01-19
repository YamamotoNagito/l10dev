<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureLabelsTable extends Migration
{
    public function up()
    {
        Schema::create('lectureLabels', function (Blueprint $table) {
            $table->unsignedBigInteger('lectureId');
            $table->unsignedBigInteger('labelId');
            
            // 外部キー制約を追加
            $table->foreign('lectureId')->references('lectureId')->on('lectures')->onDelete('cascade');
            $table->foreign('labelId')->references('labelId')->on('labels')->onDelete('cascade');

            $table->unique(['lectureId', 'labelId']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lectureLabels');
    }
};