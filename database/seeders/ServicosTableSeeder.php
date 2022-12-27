<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicos')
            ->insert(array(
            0=>
            array(
                'id' => 0,
                'ser_name' => 'Serviço Padrão',
                'area_id' => 1,
                'ser_price' => 1.0,
                'ser_sessions' => 1,
            )
            ));
    }
}
