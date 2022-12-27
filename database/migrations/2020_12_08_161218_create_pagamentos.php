<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentos extends Migration
{
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ord_id')->unsigned()->nullable();
            $table->double('pag_price');
            $table->integer('pag_type'); // 0 para a receber, 1 para a pagar
            $table->integer('pag_indicator'); // a vista ou a prazo, 1 para a vista,
            // 2 ou mais para a prazo (sendo o número a quantidade de parcelas)
            $table->bigInteger('mei_id')->unsigned();
            $table->integer('pag_open'); // indica se a conta a receber está em aberto. 0 para aberto, 1 para encerrado, 2 para cancelado
            $table->bigInteger('con_id')->unsigned();
            $table->bigInteger('clie_id')->unsigned()->nullable();
            $table->bigInteger('pro_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('ord_id')
                ->references('id')
                ->on('ordem_de_servicos');
            $table->foreign('mei_id')
                ->references('id')
                ->on('meios_pagamento');
            $table->foreign('con_id')
                ->references('id')
                ->on('contas_bancarias');
            $table->foreign('clie_id')
                ->references('id')
                ->on('clientes');
            $table->foreign('pro_id')
                ->references('id')
                ->on('profissionais');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
