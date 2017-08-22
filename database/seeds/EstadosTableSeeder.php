<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'estado' => 'Soltero(a)'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Casado(a)'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Sepado(a)/Divorciado(a)'
        ]);

        DB::table('estados')->insert([
            'estado' => 'Viudo(a)'
        ]);
    }
}
