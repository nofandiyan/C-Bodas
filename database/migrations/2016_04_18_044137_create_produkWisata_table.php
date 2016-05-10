<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkWisata', function (Blueprint $table) {
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
            $table->string('ticketStock');
            $table->string('price');
            $table->string('fotoWisata1');
            $table->string('fotoWisata2');
            $table->string('fotoWisata3');
            $table->string('fotoWisata4');
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
        Schema::drop('produkWisata');
    }
}
