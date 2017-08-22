<?php

use Illuminate\Database\Seeder;

class SituacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situaciones')->insert([
            'situacion' => 'No tengo empleo'
        ]);

        DB::table('situaciones')->insert([
            'situacion' => 'Estoy buscando empleo'
        ]);

        DB::table('situaciones')->insert([
            'situacion' => 'Estoy trabajando actualmente'
        ]);

        DB::table('situaciones')->insert([
            'situacion' => 'No estoy buscando empleo'
        ]);
    }
}
