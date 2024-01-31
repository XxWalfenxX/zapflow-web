<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentDetailsController extends Controller
{
    public function create($id): Response
    {
        return Inertia::render('User/Payment/PaymentDetails', [
            'bono' => DB::table('suscripciones')->where('id', '=', $id)->get()
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $result = DB::table('tener')->where('id_user', $request->idUser)->where('id_subscripciones',$request->idBono)->where('fecha_fin','>', DB::raw('DATE_ADD(CURDATE(), INTERVAL 1 YEAR)'))->first();


        if ($result) {
            return redirect(url()->previous())
                    ->withErrors('Este bono sigue vigente')
                    ->withInput();
        } else {
            DB::table('tener')->insert(
                ['id_user' => $request->idUser, 'id_subscripciones' => $request->idBono, 'fecha_inicio' =>  DB::raw('CURDATE()'), 'fecha_fin' => DB::raw('DATE_ADD(CURDATE(), INTERVAL 1 YEAR)')]
            );
        }

        return Redirect::to('/mis-compras');
    }
}
