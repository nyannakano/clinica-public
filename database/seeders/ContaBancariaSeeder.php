<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContaBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contas_bancarias')
            ->insert(array(
               0=>
               array(
                   'id' => 1,
                   'con_name' => 'Caixinha'
               )
            ));
    }
}
