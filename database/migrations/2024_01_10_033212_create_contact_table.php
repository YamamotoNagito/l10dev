<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id('contactId');
            $table->string('name');
            $table->string('email');
            $table->string('category');
            $table->text('message',2048);
            $table->timestamp('createdAt')->default(now());
            // $table->timestamp(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
