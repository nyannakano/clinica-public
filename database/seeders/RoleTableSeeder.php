<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            0=>
            array(
                'id' => 1,
                'rol_name' => 'Membro'
            ),
            1=>
            array(
                'id' => 2,
                'rol_name' => 'Admin'
            )
        ));
    }
}
