<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfissionaisPrestaServicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profissional_servico')
            ->insert(array(
               0=>
               array(
                   'id' => 1,
                   'profissional_id' => 1,
                   'servico_id' => 1
               )
            ));
    }
}
