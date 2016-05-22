<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detail_product_id')->unsigned();
            $table->foreign('detail_product_id')->references('id')->on('detail_products');
            $table->decimal('price',19,0);
            $table->rememberToken();
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
        Schema::drop('prices_products');
    }
}
