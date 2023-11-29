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
            ['nombre' => 'ZapFriend', 'descripcion' => 'Turismos/Furgonetas/Motos/Hasta 4 personas', 'precio'=> 50],
            ['nombre' => 'ZapMoto', 'descripcion' => 'Exclusiva para motos/1 Persona', 'precio'=> 15],
            ['nombre' => 'ZapPro', 'descripcion' => 'Turismos/Furgonetas/Motos/Carga a Ultrarápida/1 Persona', 'precio'=> 100],
            ['nombre' => 'ZapMoto Pro', 'descripcion' => 'Explusiva para motos/Carga a Ultrarápida/1 Persona', 'precio'=> 45],
            ['nombre' => 'ZapOne', 'descripcion' => 'Turismos/Furgonetas/Motos/1 Persona', 'precio'=> 25],
        ]);

        DB::table('asignar')->insert([
            ['id_user' => 1, 'id_roles' => 1],
            ['id_user' => 2, 'id_roles' => 1],
            ['id_user' => 3, 'id_roles' => 1],
            ['id_user' => 4, 'id_roles' => 1],
            ['id_user' => 5, 'id_roles' => 1],
            ['id_user' => 6, 'id_roles' => 1],
            ['id_user' => 7, 'id_roles' => 1],
            ['id_user' => 8, 'id_roles' => 1],
            ['id_user' => 9, 'id_roles' => 1],
            ['id_user' => 10, 'id_roles' => 1],
            ['id_user' => 1, 'id_roles' => 6],
            ['id_user' => 2, 'id_roles' => 6],
        ]);

        DB::table('cargar')->insert([
            ['id_user' => 1, 'id_punto_carga' => 1],
            ['id_user' => 2, 'id_punto_carga' => 2],
            ['id_user' => 3, 'id_punto_carga' => 3],
            ['id_user' => 4, 'id_punto_carga' => 4],
            ['id_user' => 5, 'id_punto_carga' => 5],
        ]);

        DB::table('tener')->insert([
            ['id_user' => 1, 'id_subscripciones' => 1, 'fecha_inicio' => '2023-10-10', 'fecha_fin' => NULL],
            ['id_user' => 2, 'id_subscripciones' => 2, 'fecha_inicio' => '2023-10-10', 'fecha_fin' => NULL],
            ['id_user' => 3, 'id_subscripciones' => 3, 'fecha_inicio' => '2023-10-10', 'fecha_fin' => NULL],
            ['id_user' => 4, 'id_subscripciones' => 4, 'fecha_inicio' => '2023-10-10', 'fecha_fin' => NULL],
            ['id_user' => 5, 'id_subscripciones' => 5, 'fecha_inicio' => '2023-10-10', 'fecha_fin' => NULL],
        ]);
    }
}
