<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AdminBonosController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminBonos', [
            'bonos' => DB::table('suscripciones')->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {


        $res = implode('/', $request->des);

        $result = DB::table('suscripciones')->where('nombre', $request->name)->first();

        if ($result) {
            return redirect(url()->previous())
                    ->withErrors('Bono existente')
                    ->withInput();
        } else {
            DB::table('suscripciones')->insertGetId(
                ['nombre' => $request->name, 'descripcion' => $res, 'precio' => $request->precio]
            );
        }

        return Redirect::to('/admin/bonos');
    }

    public function udpate(Request $request): RedirectResponse
    {
        $res = implode('/', $request->des);
        DB::table('suscripciones')
                ->where('id', $request->id)
                ->update(['nombre' => $request->name, 'descripcion' => $res, 'precio' => $request->precio]);

        return Redirect::to('/admin/bonos');
    }


    public function destroy(Request $request): RedirectResponse
    {
        DB::table('tener')->where('id_subscripciones', $request->id)->delete();
        DB::table('suscripciones')->delete($request->id);

        return Redirect::to('/admin/bonos');
    }
}
