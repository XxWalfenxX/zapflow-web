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

class AdminBonosController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminBonos', [
            'bonos' => DB::table('suscripciones')->get()
        ]);
    }


    public function destroy(Request $request): RedirectResponse
    {
        DB::table('tener')->where('id_subscripciones', $request->id)->delete();
        DB::table('suscripciones')->delete($request->id);

        return Redirect::to('/admin/bonos');
    }
}
