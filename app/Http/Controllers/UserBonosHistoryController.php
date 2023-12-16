<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class UserBonosHistoryController extends Controller
{
    public function create(Request $request): Response{
        $user = $request->user();

        return Inertia::render('User/BonosHistory', [
            'bonosComprados' =>  DB::table('tener')
                            ->join('suscripciones', 'suscripciones.id', '=', 'tener.id_subscripciones')
                            ->select('suscripciones.*', 'tener.fecha_inicio')->where('id_user', $user->id)
                            ->get()
        ]);
    }
}
