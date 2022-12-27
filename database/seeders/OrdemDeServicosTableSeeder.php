<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdemDeServicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ordem_de_servicos')->insert(array(
           0=>
           array(
               'id' => 1,
               'pro_id' => 1,
               'ser_id' => 1,
               'cli_id' => 1,
               'ord_sessions' => 4,
               'ord_status' => 0,
               'ord_description' => 'Descrição da ordem de serviço, exemplo.',
               'ord_additional' => 'Informação adicional da ordem de serviço, exemplo.',
               'ord_del' => 0
           )
        ));
    }
}
