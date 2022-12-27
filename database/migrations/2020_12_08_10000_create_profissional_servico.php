<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfissionalServico extends Migration
{
    public function up()
    {
        Schema::create('profissional_servico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profissional_id')->unsigned();
            $table->bigInteger('servico_id')->unsigned();
            $table->timestamps();
            $table->foreign('profissional_id')
                ->references('id')
                ->on('profissionais');
            $table->foreign('servico_id')
                ->references('id')
                ->on('servicos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profissional_servico');
    }
}
