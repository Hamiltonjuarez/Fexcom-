<?php

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Module::firstOrCreate([
            'name' => 'planillas',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);

        Module::firstOrCreate([
            'name' => 'contabilidad general',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);

        Module::firstOrCreate([
            'name' => 'cuentas por pagar',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);
        Module::firstOrCreate([
            'name' => 'control bancario',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);
        Module::firstOrCreate([
            'name' => 'facturacion',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);
        Module::firstOrCreate([
            'name' => 'control de nomina',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);
        Module::firstOrCreate([
            'name' => 'activo fijo',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);
        Module::firstOrCreate([
            'name' => 'cuentas por cobrar',
            'description' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod
                                tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.'
        ]);
    }
}