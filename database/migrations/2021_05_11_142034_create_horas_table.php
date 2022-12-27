<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profissional_id')->unsigned();
            $table->bigInteger('dia_id')->unsigned();
            $table->time('horas_start');
            $table->time('horas_interval')->nullable();
            $table->time('horas_return')->nullable();
            $table->time('horas_end');
            $table->foreign('profissional_id')->references('id')->on('profissionais');
            $table->foreign('dia_id')->references('id')->on('dias');
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
        Schema::dropIfExists('horas');
    }
}
