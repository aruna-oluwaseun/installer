<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slogan')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('liability')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->mediumText('about')->nullable();
            $table->text('company_video')->nullable();
            $table->text('business_hours')->nullable();
            $table->json('address_data')->nullable();
            $table->string('gps_lat',30)->nullable();
            $table->string('gps_lng',30)->nullable();
            $table->string('registration_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->enum('registered_as',['limited','sole-trader'])->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('views')->default(0);
            $table->dateTime('verified')->nullable();
            $table->enum('status',['active','draft','pending'])->default('draft');
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
        Schema::dropIfExists('companies');
    }
}
