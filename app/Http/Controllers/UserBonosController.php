<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class UserBonosController extends Controller
{
    public function create(Request $request): Response{
        $user = $request->user();

        $dbListaBonos = DB::table('suscripciones')->get();

        foreach ($dbListaBonos as &$data ){
            $data->descripcion = explode("/", $data->descripcion);
        }

        return Inertia::render('User/Bonos', [
            'bonosUsuario' =>  DB::table('tener')
                            ->join('suscripciones', 'suscripciones.id', '=', 'tener.id_subscripciones')
                            ->select('suscripciones.id', 'tener.fecha_fin')->where('id_user', $user->id)
                            ->get(),
            'listaBonos' => $dbListaBonos
        ]);
    }
}
