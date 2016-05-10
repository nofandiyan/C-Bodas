<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTernakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkTernak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMerchant')->unsigned();;
            $table->foreign('idMerchant')->references('id')->on('users');
            $table->string('title');
            $table->string('desc');
            $table->string('year');
            $table->string('month');
            $table->string('day');
            $table->string('gender');
            $table->string('weight');
            $table->string('price');
            $table->string('fotoTernak1');
            $table->string('fotoTernak2');
            $table->string('fotoTernak3');
            $table->string('fotoTernak4');
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
        Schema::drop('produkTernak');
    }
}
