<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeleteReviewRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('deleteReviewRequests', function (Blueprint $table) {

            $table->unsignedBigInteger('reviewId');
            $table->unsignedBigInteger('userId');
            $table->foreign('reviewId')->references('reviewId')->on('reviews')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
            $table->timestamp('createdAt')->default(now());

            $table->unique(['reviewId', 'userId']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('deleteRequests');
    }
};