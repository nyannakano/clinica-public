<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentos extends Migration
{
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color', 7);
            $table->string('description')->nullable();
            $table->integer('status')->default(0); // 0 nao confirmado, 1 confirmado, 2 cancelado
            $table->integer('auth')->default(1); // 1 aprovado/agendamento interno. 0 agendamento por cliente não aprovado pela clinica.
            $table->integer('del')->default(0);
            $table->double('price')->default(0);
            $table->bigInteger('ord_id')->unsigned()->nullable();
            $table->bigInteger('clie_id')->unsigned()->nullable();
            $table->bigInteger('pro_id')->unsigned()->nullable();
            $table->bigInteger('ser_id')->unsigned()->nullable();
            $table->foreign('ord_id')->references('id')
                ->on('ordem_de_servicos');
            $table->foreign('clie_id')->references('id')
                ->on('clientes');
            $table->foreign('ser_id')->references('id')
                ->on('servicos');
            $table->foreign('pro_id')->references('id')
                ->on('profissionais');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
