<?php

use Illuminate\Database\Seeder;

class IdentificacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identificaciones')->insert([
            'identificacion' => 'Cédula de ciudadanía'
        ]);

        DB::table('identificaciones')->insert([
            'identificacion' => 'Cédula de extranjería'
        ]);

        DB::table('identificaciones')->insert([
            'identificacion' => 'Tarjeta de identidad'
        ]);

        DB::table('identificaciones')->insert([
            'identificacion' => 'Pasaporte'
        ]);
    }
}
