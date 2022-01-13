<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('from_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('to_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->string('from_name')->nullable();
            $table->string('to_name')->nullable();
            $table->string('to_email')->nullable();
            $table->text('message');
            $table->dateTime('read')->nullable()->comment('Read by customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_replies');
    }
}
