<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicos extends Migration
{
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ser_name', 255);
            $table->bigInteger('area_id')->unsigned();
            $table->double('ser_price')->default(0.0);
            $table->integer('ser_sessions')->default(1);
            $table->integer('ser_del')->default(0);
            $table->integer('ser_availability')->default(1);
            $table->time('ser_time')->default("01:00"); // tempo mínimo para realizar serviço
            $table->string('ser_image')->default('servico_padrao')->nullable();
            $table->timestamps();
            $table->foreign('area_id')
                ->references('id')
                ->on('areas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicos');
    }
}
