<?php

use Illuminate\Database\Seeder;

class TipousersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipousers')->insert([
            'tipouser' => 'Administrador'
        ]);

        DB::table('tipousers')->insert([
            'tipouser' => 'Persona'
        ]);

        DB::table('tipousers')->insert([
            'tipouser' => 'Empresa'
        ]);
    }
}
