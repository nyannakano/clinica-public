<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exceptions', function (Blueprint $table) {
            $table->id();
            $table->time('exc_horas_start'); // hora inicial da excessão
            $table->time('exc_horas_end'); // hora final da excessão
            $table->date('exc_dia'); // dia em que será feito esta excessão
            $table->bigInteger('profissional_id')->unsigned();
            $table->foreign('profissional_id')->references('id')
                ->on('profissionais');
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
        Schema::dropIfExists('exceptions');
    }
}
