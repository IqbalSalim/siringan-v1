<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("house_id");
            $table->unsignedBigInteger("product_id");
            $table->integer('qty');
            $table->string('info');
            $table->foreign("house_id")->references("id")->on("houses");
            $table->foreign("product_id")->references("id")->on("products");
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
        Schema::dropIfExists('house_product');
    }
}
