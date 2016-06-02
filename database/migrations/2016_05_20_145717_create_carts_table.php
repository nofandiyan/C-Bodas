<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->integer('detail_product_id')->unsigned();
            $table->foreign('detail_product_id')->references('id')->on('detail_products');
            $table->integer('reservation_id')->unsigned();
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->integer('price_id')->unsigned();
            $table->foreign('price_id')->references('id')->on('prices_products');
            $table->integer('amount',10);
            $table->date('schedule')->nullable();
            $table->string('status','10');
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
        Schema::drop('carts');
    }
}
