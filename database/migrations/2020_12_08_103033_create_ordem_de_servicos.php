<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemDeServicos extends Migration
{
    public function up()
    {
        Schema::create('ordem_de_servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pro_id')->unsigned();
            $table->bigInteger('ser_id')->unsigned();
            $table->bigInteger('cli_id')->unsigned();
            $table->string('ord_description')->nullable();
            $table->string('ord_additional')->nullable();
            $table->integer('ord_sessions')->default(1);
            $table->integer('ord_del')->default(0); // 0 não deletado, 1 deletado
            $table->integer('ord_status')->default(0); // 0 em aberto, 1 encerrado, 2 cancelado
            $table->timestamps();
            $table->foreign('pro_id')
                ->references('id')
                ->on('profissionais');
            $table->foreign('ser_id')
                ->references('id')
                ->on('servicos');
            $table->foreign('cli_id')
                ->references('id')
                ->on('clientes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordem_de_servicos');
    }
}
