<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(TipousersTableSeeder::class);
        $this->call(IdentificacionesTableSeeder::class);
        $this->call(IdiomasTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        //los municipios deben cargarse mnanual error desconocido
        $this->call(MunicipiosTableSeeder::class);
        //$this->call(Municipios2TableSeeder::class);
        //$this->call(Municipio3TableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(LiceciasTableSeeder::class);
        $this->call(SituacionesTableSeeder::class);
        $this->call(SectoresTableSeeder::class);
        $this->call(NivelesTableSeeder::class);
        $this->call(InivelesTableSeeder::class);
        $this->call(ProfesionesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
