<?php

use Illuminate\Database\Seeder;

class NivelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveles')->insert([
           'nivel' => 'Educación básica primaria' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Educación básica secundaria' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Bachillerato / Educación media' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Universidad / Carrera técnica' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Universidad / Carrera tecnológica' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'universidad / Carrera profesional' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Postgrado / Especialización' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Postgrado / Maestría' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Postgrado / Doctorado' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Seminario' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Diplomado' 
        ]);

        DB::table('niveles')->insert([
           'nivel' => 'Certificación' 
        ]);
    }
}
