<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MapController extends Controller
{
    public function index()
    {
        return response()->json(DB::select('select * from puntos_carga')) ;
    }
}
