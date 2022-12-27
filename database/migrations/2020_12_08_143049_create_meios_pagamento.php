<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeiosPagamento extends Migration
{
    public function up()
    {
        Schema::create('meios_pagamento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mei_name', 255);
            $table->integer('mei_indicator')->default(1);
            // o indicator vai funcionar assim:
            // 1 = Pagamentos a vista
            // 2 ou mais = Pagamentos a prazo, e o número define a quantidade de parcelas padrão
            // note que tem uma coluna também na table de pagamentos para valores
            // pois esse número poderá ser sobrescrito no momento do registro da conta a pagar
            $table->integer('mei_del')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meios_pagamento');
    }
}
