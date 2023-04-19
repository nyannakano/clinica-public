<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(ProfissionaisTableSeeder::class);
        $this->call(ServicosTableSeeder::class);
        $this->call(ProfissionaisPrestaServicosTableSeeder::class);
        $this->call(OrdemDeServicosTableSeeder::class);
        $this->call(ContaBancariaSeeder::class);
        $this->call(MeiosDePagamentoSeeder::class);
        $this->call(PagamentosSeeder::class);
        $this->call(AgendamentoTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
