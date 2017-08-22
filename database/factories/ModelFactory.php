<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'tipouser_id' => $faker->numberBetween($min = 1, $max = 3),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'activo' => '1',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Curriculo::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'identificacione_id' => $faker->numberBetween($min = 1, $max = 4),
        'numero_identificacion' => $faker->randomNumber($nbDigits = 8),
        'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'estado_id' => $faker->numberBetween($min = 1, $max = 4),
        'telefono' => $faker->e164PhoneNumber,
        'municipio_id' => App\Municipio::inRandomOrder()->first()->id,
        'direccion' => $faker->address,
        'paise_id' => App\Paise::inRandomOrder()->first()->id,
        'discapacidad' => $faker->boolean(75),
        'foto' => 'https://s3-sa-east-1.amazonaws.com/generandoempleo/generandoempleo/user1/foto/foto.jpg',
        'profesione_id' => App\Profesione::inRandomOrder()->first()->id,
        'descripcion' => $faker->text($maxNbChars = 200),
        'situacione_id' => App\Situacione::inRandomOrder()->first()->id,
        'salario' =>  $faker->randomNumber($nbDigits = 6),
        'disponibilidad_viajar' =>  $faker->boolean(75),
        'disponibilidad_cambio_residencia' =>  $faker->boolean(35),
    ];

});
