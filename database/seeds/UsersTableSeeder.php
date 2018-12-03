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
            'name' => 'Administrador',
            'lastname' => '',
            'email' => 'admin@nidiasoft.com',
            'password' => bcrypt('admin'),
            'phone' => '',
            'role' => 1,
            'title' => ''
        ]);

        DB::table('doctors')->insert([
            'user_id' => 1,
            'specialty' => '',
            'university' => '',
            'professional_license' => ''
        ]);
    }
}
