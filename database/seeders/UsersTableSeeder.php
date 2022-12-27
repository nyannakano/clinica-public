<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            0=>
            array(
                'id' => 1,
                'name' => 'admin',
                'email' => 'email@email.com',
                'password' => Hash::make('123'),
                'roles_id' => 2,
            )
        ));
    }
}
