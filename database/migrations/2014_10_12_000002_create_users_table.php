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
            $table->string('role',10);
            $table->string('email',30)->unique();
            $table->string('password',100);
            $table->string('name',50);
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('phone',15);
            $table->string('street',50);
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('zip_code',5);
            $table->string('confirmation_code');
            $table->enum('status', ['0', '1']);
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
