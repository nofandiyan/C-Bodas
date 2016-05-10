<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukVillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkVilla', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMerchant')->unsigned();;
            $table->foreign('idMerchant')->references('id')->on('users');
            $table->string('title');
            $table->string('desc');
            $table->string('street');
            $table->string('village');
            $table->string('city');
            $table->string('prov');
            $table->string('zipCode');
            $table->string('dateOrdered');
            $table->string('quota');
            $table->string('price');
            $table->string('fotoVilla1');
            $table->string('fotoVilla2');
            $table->string('fotoVilla3');
            $table->string('fotoVilla4');
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
        Schema::drop('produkVilla');
    }
}
