<?php

use Illuminate\Database\Seeder;

class IdiomasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('idiomas')->insert([
            'idioma' => 'Español'
        ]);

        DB::table('idiomas')->insert([
            'idioma' => 'ingles'
        ]);
    }
}
