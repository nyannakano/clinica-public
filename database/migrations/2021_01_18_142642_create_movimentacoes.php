<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacoes extends Migration
{
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mov_description', 255)->nullable();
            $table->integer('mov_type'); // Receita ou Despesa
            $table->double('mov_value');
            $table->bigInteger('clie_id')->unsigned()->nullable();
            $table->bigInteger('pro_id')->unsigned()->nullable();
            $table->bigInteger('par_id')->unsigned()->nullable();
            $table->bigInteger('con_id')->unsigned();
            $table->date('mov_date')->nullable();
            $table->integer('mov_cancel')->default(0); // 0 para lançado, 1 para cancelado
            $table->foreign('clie_id')->references('id')->on('clientes');
            $table->foreign('pro_id')->references('id')->on('profissionais');
            $table->foreign('par_id')->references('id')->on('parcelas');
            $table->foreign('con_id')->references('id')->on('contas_bancarias');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimentacoes');
    }
}
