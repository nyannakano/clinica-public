<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agendamentos')->insert(
            [
             0=>
                [
                    'title' => 'Ricardo',
                    'start' => '2020-12-27 22:00:00',
                    'end' => '2020-12-27 23:00:00',
                    'color' => '#7FFFD4',
                    'description' => 'Agendamento para testes',
                    'status' => 0,
                    'del' => 0
                ]
            ]
        );
    }
}
