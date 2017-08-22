<?php

use Illuminate\Database\Seeder;

class SectoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sectores')->insert([
            'sector' => 'Agricultura / Pesca / Ganadería'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Construcción / obras'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Educación'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Energía'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Entretenimiento / Deportes'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Fabricación'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Finanzas / Banca'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Gobierno / No Lucro'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Hostelería / Turismo'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Informática / Hardware'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Informática / Software'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Internet'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Legal / Asesoría'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Materias Primas'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Medios de Comunicación'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Publicidad / RRPP'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'RRHH / Personal'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Salud / Medicina'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Servicios Profesionales'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Telecomunicaciones'
        ]);  

        DB::table('sectores')->insert([
            'sector' => 'Transporte'
        ]);  

        DB::table('sectores')->insert([
            'sector' => 'Venta al consumidor'
        ]);

        DB::table('sectores')->insert([
            'sector' => 'Venta al por mayor'
        ]); 
        
        
        
        
        
        
        
        
        
    }
}
