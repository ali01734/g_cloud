<?php

use Illuminate\Database\Seeder;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'is_admin' => 1,
            'username' => 'admin',
            'firstName' => 'Amine',
            'lastName' => 'Allouach',
            'email' => 'admin@nataalam.com',
            'password' => Hash::make('kawkaw123'),
        ]);
    }
}
