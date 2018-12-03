<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            [
                'key' => 'app.name',
                'value' => 'SISGEC'
            ],
            [
                'key' => 'app.lang',
                'value' => 'es'
            ],
            [
                'key' => 'app.office_logo',
                'value' => asset("images/sisgec-logo.png")
            ],
            [
                'key' => 'app.office_brand',
                'value' => asset("images/sisgec-brand.png")
            ]
        ]);
    }
}
