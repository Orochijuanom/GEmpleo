<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'area' => 'Administración / Oficina'
        ]);

        DB::table('areas')->insert([
            'area' => 'Almacén / Logística / Transporte'
        ]);

        DB::table('areas')->insert([
            'area' => 'Atención a clientes'
        ]);

        DB::table('areas')->insert([
            'area' => 'CallCenter / Telemercadeo'
        ]);

        DB::table('areas')->insert([
            'area' => 'Construccion y obra'
        ]);

        DB::table('areas')->insert([
            'area' => 'Contabilidad / Finanzas'
        ]);

        DB::table('areas')->insert([
            'area' => 'Dirección / Gerencia'
        ]);

        DB::table('areas')->insert([
            'area' => 'Diseño / Artes gráficas'
        ]);

        DB::table('areas')->insert([
            'area' => 'Docencia'
        ]);

        DB::table('areas')->insert([
            'area' => 'Hostelería / Turismo'
        ]);

        DB::table('areas')->insert([
            'area' => 'Informática / Telecomunicaciones'
        ]);

        DB::table('areas')->insert([
            'area' => 'Ingeniería'
        ]);

        DB::table('areas')->insert([
            'area' => 'Investigación y Calidad'
        ]);

        DB::table('areas')->insert([
            'area' => 'Legal / Asesoría'
        ]);

        DB::table('areas')->insert([
            'area' => 'Mantenimiento y Reparaciones Técnicas'
        ]);

        DB::table('areas')->insert([
            'area' => 'Medicina / Salud'
        ]);

        DB::table('areas')->insert([
            'area' => 'Mercadotécnia / Publicidad / Comunicación'
        ]);

        DB::table('areas')->insert([
            'area' => 'Producción / Operarios / Manufactura'
        ]);

        DB::table('areas')->insert([
            'area' => 'Recursos Humanos'
        ]);

        DB::table('areas')->insert([
            'area' => 'Servicios Generales, Aseo y Seguridad '
        ]);

        DB::table('areas')->insert([
            'area' => 'Ventas'
        ]);   
    }
}
