<?php


use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::firstOrCreate([
            'name' => 'El Salvador',
            'postal_number' =>  '(503)'
        ]);

        Country::firstOrCreate([
            'name' => 'Belize',
            'postal_number' =>  '(501)'
        ]);


        Country::firstOrCreate([
            'name' => 'Guatemala',
            'postal_number' =>  '(502)'
        ]);

        Country::firstOrCreate([
            'name' => 'Honduras',
            'postal_number' =>  '(504)'
        ]);

        Country::firstOrCreate([
            'name' => 'Costa Rica',
            'postal_number' =>  '(506)'
        ]);

        Country::firstOrCreate([
            'name' => 'Panama',
            'postal_number' =>  '(507)'
        ]);
    }
}
