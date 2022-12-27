<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientes extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clie_name', 255);
            $table->string('clie_email')->nullable();
            $table->string('clie_phone', 11)->nullable();
            $table->date('clie_bornday')->nullable();
            $table->string('clie_cpf', 11)->nullable();
            $table->string('clie_address_street', 255)->nullable();
            $table->string('clie_address_district', 255)->nullable();
            $table->string('clie_address_complement', 255)->nullable();
            $table->string('clie_address_number')->nullable();
            $table->string('clie_address_zipcode', 9)->nullable();
            $table->integer('city_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->integer('clie_del')->default(0);
            $table->timestamps();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
