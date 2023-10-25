<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BonosController extends Controller
{
    public function index() {
        $bonos = DB::table('suscripciones')->get();

        foreach ($bonos as &$data ){
            $data->descripcion = explode(",", $data->descripcion);
        }

        return  $bonos;
    }
}
