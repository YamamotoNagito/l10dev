<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeleteReviewRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('delete_review_requests', function (Blueprint $table) {

            $table->unsignedBigInteger('review_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('review_id')->references('review_id')->on('reviews')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->default(now());

            $table->unique(['review_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('delete_requests');
    }
};