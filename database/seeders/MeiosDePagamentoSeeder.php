<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeiosDePagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meios_pagamento')
            ->insert(array(
                0 =>
                array(
                    'id' =>  1,
                    'mei_name' => 'Dinheiro',
                    'mei_indicator' => 1,
                ),
                1 =>
                array(
                    'id' => 2,
                    'mei_name' => 'Cartão de Crédito',
                    'mei_indicator' => 2,
                )
            ));
    }
}
