<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id('label_id');
            $table->string('label_name')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labels');
    }
};