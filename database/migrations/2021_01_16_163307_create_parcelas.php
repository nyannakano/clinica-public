<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelas extends Migration
{
    public function up()
    {
        Schema::create('parcelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('par_price');
            $table->integer('par_number');
            $table->date('par_deadline');
            $table->date('par_date')->nullable(); // data que foi lançado o recebimento
            $table->bigInteger('pag_id')->unsigned();
            $table->integer('par_status')->default(0); // 0 em aberto, 1 encerrado, 2 cancelado
            $table->integer('par_type'); // vai fazer mais sentido depois, mas 0 é para contas a receber e 1 contas a pagar
            $table->foreign('pag_id')
                ->references('id')
                ->on('pagamentos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcelas');
    }
}
