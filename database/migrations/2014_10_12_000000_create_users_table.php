<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('userAs')->default(0);
            $table->string('profPict');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('typeId');
            $table->string('noId');
            $table->string('name');
            $table->string('telp');
            $table->string('street');
            $table->string('city');
            $table->string('prov');
            $table->string('zipCode');
            $table->string('bankName');
            $table->string('rekName');
            $table->string('rekId');
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
        Schema::drop('users');
    }
}
