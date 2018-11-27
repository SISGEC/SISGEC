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
        DB::table('users')->insert([
            'name' => 'Jesús',
            'lastname' => 'Magallón',
            'email' => 'magallonj23@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '(322) 1154 503',
            'role' => 1
        ]);
    }
}
