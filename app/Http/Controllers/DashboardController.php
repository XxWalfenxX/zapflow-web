<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function create(Request $request): Response{
        $user = $request->user();
        $now = now()->toDateString(); // Obtener la fecha actual sin la hora

        return Inertia::render('User/Dashboard', [
            'bonoInfo' =>  DB::table('tener')
                            ->join('suscripciones', 'suscripciones.id', '=', 'tener.id_subscripciones')
                            ->select('suscripciones.nombre', 'tener.fecha_fin')->where('id_user', $user->id)->where('tener.fecha_fin', '>=', $now)
                            ->get()
        ]);
    }
}
