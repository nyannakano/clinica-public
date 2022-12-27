<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert(array(
            0=>
            array(
                'id' => 1,
                'area_name' => 'Área Padrão'
            )
        ));
    }
}
