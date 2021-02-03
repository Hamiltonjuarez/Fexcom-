<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class DatabaseSeeder extends Seeder
{

    use Seedable;

    protected $seedersPath;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedersPath = database_path('seeds').'/';
        $this->seed('VoyagerDatabaseSeeder');
        \App\Models\User::factory(200)->create();
    }
}
