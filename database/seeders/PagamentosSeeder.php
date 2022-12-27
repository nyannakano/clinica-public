<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pagamentos')
            ->insert(array(
               0=>
               array(
                   'id' => 1,
                   'ord_id' => 1,
                   'pag_price' => 99.45,
                   'pag_indicator' => 1,
                   'mei_id' => 1,
                   'pag_open' => 1,
                   'con_id' => 1,
                   'pag_type' => 1,
               )
            ));
    }
}
