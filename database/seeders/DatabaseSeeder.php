<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $iUsers = 1;

        while ($iUsers <= 10) {
            DB::table('users')->insert([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'created_at' => DB::raw('curdate()')
            ]);
            $iUsers++;
        }

        DB::table('puntos_carga')->insert([
            ['latitud' => 41.44272369755173 , 'longitud' => 2.199516611293162, 'ubicacion' => 'Passeig de Potosí, 08001 Barcelona, Spain', 'potencia' => 5.5, 'funciona' => 1, 'ultimo_mantenimiento' => NULL],
            ['latitud' => 41.44322387844313 , 'longitud' => 2.2060227203204485, 'ubicacion' => 'Passeig de Guayaquil, 08001 Barcelona, Spain', 'potencia' => 6.8, 'funciona' => 1, 'ultimo_mantenimiento' => NULL],
            ['latitud' => 41.444675778253924 , 'longitud' => 2.207538168413863, 'ubicacion' => 'Passeig de la Salzereda, 08922 Santa Coloma de Gramenet, Spain', 'potencia' => 6.8, 'funciona' => 1, 'ultimo_mantenimiento' => NULL],
            ['latitud' => 41.442271256596264 , 'longitud' => 2.193070283366465, 'ubicacion' => 'Carrer de Palomar, 08001 Barcelona, Spain', 'potencia' => 5.5, 'funciona' => 0, 'ultimo_mantenimiento' => NULL],
            ['latitud' => 41.437055472099686 , 'longitud' => 2.1841619466675954, 'ubicacion' => 'Centre Esportiu Can Dragó, Carrer de Rosselló i Porcel, 08001 Barcelona, Spain', 'potencia' => 6.8, 'funciona' => 1, 'ultimo_mantenimiento' => NULL],
        ]);

        DB::table('roles')->insert([
            ['nombre' => 'user'],
            ['nombre' => 'empleado'],
            ['nombre' => 'dplegal'],
            ['nombre' => 'dpgeneral'],
            ['nombre' => 'dpcomercial'],
            ['nombre' => 'admin'],
        ]);

        DB::table('suscripciones')->insert([
            ['nombre' => 'EcoFriend', 'descripcion' => 'Suscripcion anual para turismos, furgonetas y motos, compatible con dos familiares', 'precio'=> 50],
            ['nombre' => 'EcoMoto', 'descripcion' => 'Suscripcion anual, explusiva para motos', 'precio'=> 25],
            ['nombre' => 'EcoPro', 'descripcion' => 'Suscripcion anual para turismos furgonetas y motos, especial para profesionales', 'precio'=> 100],
            ['nombre' => 'EcoMoto Pro', 'descripcion' => 'Suscripcion anual, explusiva para motos, especial para profesionales', 'precio'=> 45],
            ['nombre' => 'EcoOne', 'descripcion' => 'Suscripcion anual, para turismos furgonetas y motos', 'precio'=> 25],
        ]);

    }
}
