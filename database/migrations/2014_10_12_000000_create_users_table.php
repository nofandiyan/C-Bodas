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
            $table->string('name',50);
            $table->string('email',30)->unique();
            $table->string('password',100);
            $table->string('street',50);
            $table->string('city',30);
            $table->string('province',30);
            $table->string('zip_code',5);
            $table->string('phone',15);
            $table->smallInteger('status');
            $table->string('confirmation_code',50);
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
