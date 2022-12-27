<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dias')->insert(array(
            0=>
                array(
                    'id' => '1',
                    'dia_name' => 'Domingo',
                ),
            1=>
                array(
                    'id' => '2',
                    'dia_name' => 'Segunda-feira',
                ),
            2=>
                array(
                    'id' => '3',
                    'dia_name' => 'Terça-feira',
                ),
            3=>
                array(
                    'id' => '4',
                    'dia_name' => 'Quarta-feira',
                ),
            4=>
                array(
                    'id' => '5',
                    'dia_name' => 'Quinta-feira',
                ),
            5=>
                array(
                    'id' => '6',
                    'dia_name' => 'Sexta-feira',
                ),
            6=>
                array(
                    'id' => '7',
                    'dia_name' => 'Sábado',
                ),
        ));
    }
}
