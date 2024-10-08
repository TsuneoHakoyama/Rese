<?php

namespace Database\Seeders;

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
        $this->call(GenresTableSeeder::class);
        $this->call(PrefecturesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(TimesTableSeeder::class);
        $this->call(PeoplesTableSeeder::class);
    }
}
