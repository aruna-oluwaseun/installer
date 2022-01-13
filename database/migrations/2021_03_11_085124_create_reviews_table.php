<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->double('rating')->nullable();
            $table->dateTime('verified')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('proof')->nullable();
            $table->enum('status',['pending','approved','contested','declined'])->default('pending');
            $table->date('pending_until')->nullable();
            $table->text('decline_reason')->nullable();
            $table->text('contest_reason')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
