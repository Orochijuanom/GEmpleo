<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Fernando Mejia',
            'tipouser_id' => 1,
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'activo' => 1
        ]);

        factory(App\User::class, 20)->create()->each(function ($u) {
            $u->curriculo()->save(factory(App\Curriculo::class)->make());
    });
    }
}
