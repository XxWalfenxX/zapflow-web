<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminPuntosCargaController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminPuntosCarga', [
            'puntos_carga' => DB::table('puntos_carga')->get()
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        // Convierte la fecha al formato de tiempo UNIX
        $fecha_unix = strtotime($request->ultimo_mantenimiento);

        // Formatea la fecha para MySQL
        $fecha_mysql = date("Y-m-d", $fecha_unix);

        DB::table('puntos_carga')->insertGetId(
            ['latitud' => $request->latitud, 'longitud' => $request->longitud, 'ubicacion' => $request->ubicacion, 'potencia' => $request->potencia, 'funciona' => $request->funciona, 'ultimo_mantenimiento' => $fecha_mysql]
        );

        return Redirect::to('/admin/puntos-carga');
    }
    public function destroy(Request $request): RedirectResponse
    {
        DB::table('cargar')->where('id_punto_carga', $request->id)->delete();
        DB::table('puntos_carga')->delete($request->id);

        return Redirect::to('/admin/puntos-carga');
    }
}
