<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreas extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area_name', 255);
            $table->integer('area_del')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
