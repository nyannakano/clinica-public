<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfissionaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profissionais')->insert(array(
           0 =>
           array(
               'id' => 1,
               'pro_name' => 'Profissional Padrão',
               'pro_health_plan' => 'Unimed',
               'pro_color' => '#7FFFD4',
               'area_id' => 1
           )
        ));
    }
}
