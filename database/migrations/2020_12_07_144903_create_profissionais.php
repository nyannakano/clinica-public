<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfissionais extends Migration
{
    public function up()
    {
        Schema::create('profissionais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pro_name', 255);
            $table->string('pro_health_plan', 255)->nullable(true)->default('Nenhum');
            $table->string('pro_color', 7);
            $table->bigInteger('area_id')->unsigned();
            $table->integer('pro_del')->default(0);
            $table->timestamps();
            $table->foreign('area_id')
                ->references('id')
                ->on('areas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profissionais');
    }
}
