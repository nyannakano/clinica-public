<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasBancarias extends Migration
{
    public function up()
    {
        Schema::create('contas_bancarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('con_name', 255);
            $table->string('con_bank', 255)->nullable();
            $table->double('con_balance')->default(0.0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contas_bancarias');
    }
}
