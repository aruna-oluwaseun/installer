<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('code')->nullable()->comment('Overides default service code');
            $table->string('image')->nullable()->comment('Overides default image');
            $table->integer('radius_covered')->nullable()->comment('Radius covered in miles');
            $table->mediumText('description')->nullable()->comment('Overides default service description');
            $table->tinyInteger('approved')->nullable()->comment('Approved service by Fedca');
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('company_service');
    }
}
