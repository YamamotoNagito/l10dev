<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeleteRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('delete_requests', function (Blueprint $table) {
            $table->uuid('review_id');
            $table->uuid('user_id');

            $table->foreign('review_id')->references('review_id')->on('reviews');
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delete_requests');
    }
};