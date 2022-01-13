<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('cost',10,2)->default(0.00);
            $table->decimal('was',10,2)->default(0.00)->comment('The was price so you can show a sale');
            $table->enum('billing_period',['Daily','Weekly','Monthly','Every 3 months','Every 6 months','Yearly','Custom'])->nullable();
            $table->integer('custom_interval')->nullable();
            $table->enum('custom_every',['days','weeks','months'])->nullable();
            $table->string('stripe_id')->nullable();
            $table->enum('status',['active','soon','draft'])->default('draft');
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
        Schema::dropIfExists('prices');
    }
}
