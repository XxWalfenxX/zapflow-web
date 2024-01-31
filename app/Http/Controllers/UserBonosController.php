<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class UserBonosController extends Controller
{
    public function create(Request $request): Response
    {
        $user = $request->user();

        $dbListaBonos = DB::table('suscripciones')->get();

        foreach ($dbListaBonos as &$data) {
            $data->descripcion = explode("/", $data->descripcion);
        }

        return Inertia::render('User/Bonos', [
            'bonosUsuario' =>  DB::table('tener')
                ->select('suscripciones.id', DB::raw('MAX(tener.fecha_inicio) AS fecha_inicio'), 'tener.fecha_fin')
                ->join('suscripciones', 'suscripciones.id', '=', 'tener.id_subscripciones')
                ->where('tener.id_user', '=', $user->id)
                ->groupBy('suscripciones.id', 'tener.fecha_fin')
                ->orderBy('tener.fecha_inicio', 'desc')
                ->get(),
            'listaBonos' => $dbListaBonos
        ]);
    }
}
