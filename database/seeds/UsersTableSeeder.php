<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'stwartmassmann@hotmail.com',
            'password' => bcrypt('123321')
        ]);
    }
}
