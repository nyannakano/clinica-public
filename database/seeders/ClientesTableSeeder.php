<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert(array(
            0=>
            array(
                'id' => '1',
                'clie_name' => 'Cliente Padrão',
                'city_id' => '4045'
            )
        ));
    }
}
