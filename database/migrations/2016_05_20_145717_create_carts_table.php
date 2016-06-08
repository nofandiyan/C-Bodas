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
            $table->decimal('delivery_cost',19,0)->default(0,0);
            $table->integer('amount',10);
            $table->date('schedule')->nullable();
            $table->enum('status', ['0', '1', '2', '3', '4']);
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
