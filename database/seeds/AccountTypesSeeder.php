<?php


use Illuminate\Database\Seeder;
use App\Models\Account_type;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account_type::firstOrCreate([
            'name' => 'ACTIVO',
        ]);

        Account_type::firstOrCreate([
            'name' => 'PASIVO',
        ]);

        Account_type::firstOrCreate([
            'name' => 'PATRIMONIO',
        ]);

        Account_type::firstOrCreate([
            'name' => 'INGRESOS',
        ]);

        Account_type::firstOrCreate([
            'name' => 'GASTOS',
        ]);
        
        Account_type::firstOrCreate([
            'name' => 'COSTOS',
        ]);
        
        Account_type::firstOrCreate([
            'name' => 'CUENTAS LIQUIDADORAS DE RESULTADOS',
        ]);

        Account_type::firstOrCreate([
            'name' => 'CUENTA DE MEMORANDO DEUDORAS',
        ]);

        Account_type::firstOrCreate([
            'name' => 'CUENTA DE MEMORANDO ACREEDORAS',
        ]);
    }
}
