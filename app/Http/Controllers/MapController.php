<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        $users = DB::table('puntos_carga')->get();

        return response()->json($users) ;
    }
}
