<?php

use Illuminate\Database\Seeder;

class InivelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('iniveles')->insert([
            'nivel' => 'Muy básico'
        ]);

        DB::table('iniveles')->insert([
            'nivel' => 'Básico'
        ]);

        DB::table('iniveles')->insert([
            'nivel' => 'Intermedio'
        ]);

        DB::table('iniveles')->insert([
            'nivel' => 'Avanzado'
        ]);

        DB::table('iniveles')->insert([
            'nivel' => 'Nativo'
        ]);
    }
}
