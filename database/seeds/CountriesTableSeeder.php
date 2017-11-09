<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Country::create([
            'name' => 'Brasil',
            'initials' => 'BR',
            'oficialid' => 1058
        ]);
    }
}
