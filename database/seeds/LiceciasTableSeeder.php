<?php

use Illuminate\Database\Seeder;

class LiceciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licencias')->insert([
            'licencia' => 'A1'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'A2'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'B1'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'B2'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'B3'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'C1'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'C2'
        ]);

        DB::table('licencias')->insert([
            'licencia' => 'C3'
        ]);
    }

}
