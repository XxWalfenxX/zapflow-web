<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class AdminUsersSubsController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminUserSubs', [
            'userSubs' => DB::table('tener')
                ->join('users', 'id_user', '=', 'users.id')
                ->join('suscripciones', 'id_subscripciones', '=', 'suscripciones.id')
                ->select('tener.*', 'users.email', 'suscripciones.nombre')
                ->get(),

            'bonosAvail' => DB::table('suscripciones')->select('id', 'nombre')->get(),
            'usersAvail' => DB::table('users')->select('id', 'email')->get()
        ]);
    }

    public function udpate(Request $request): RedirectResponse
    {
        // Obtener los bonos actuales del usuario desde la base de datos
        $bonosActuales = DB::table('tener')->where('id_user', '=', $request->id_user)->pluck('id_subscripciones')->toArray();

        // Obtener los bonos proporcionados en la solicitud
        $nuevosBonos = $request->input('id_bonos', []);

        // Identificar los bonos a eliminar (están en $rolesActuales pero no en $nuevosRoles)
        $bonosEliminar = array_diff($bonosActuales, $nuevosBonos);

        // Identificar los bonos a agregar (están en $nuevosRoles pero no en $rolesActuales)
        $bonosAgregar = array_diff($nuevosBonos, $bonosActuales);

        // Eliminar bonos que ya no están presentes
        if (!empty($bonosEliminar)) {
            DB::table('tener')->where('id_user', '=', $request->id_user)->whereIn('id_subscripciones', $bonosEliminar)->delete();
        }

        // Agregar nuevos bonos
        foreach ($bonosAgregar as $rol) {
            DB::table('tener')->insert(['id_user' => $request->id_user, 'id_subscripciones' => $rol, 'fecha_inicio' =>  DB::raw('CURDATE()'), 'fecha_fin' => DB::raw('DATE_ADD(CURDATE(), INTERVAL 1 YEAR)') ]);
        }

        return Redirect::to('/admin/users/suscripciones');
    }

    public function store(Request $request): RedirectResponse
    {
        $result = DB::table('tener')->where('id_user', $request->idUser)->where('id_subscripciones',$request->idBono)->first();

        if ($result) {
            return redirect(url()->previous())
                    ->withErrors('Usuario con bono existente')
                    ->withInput();
        } else {
            DB::table('tener')->insert(
                ['id_user' => $request->idUser, 'id_subscripciones' => $request->idBono, 'fecha_inicio' =>  DB::raw('CURDATE()'), 'fecha_fin' => DB::raw('DATE_ADD(CURDATE(), INTERVAL 1 YEAR)')]
            );
        }

        return Redirect::to('/admin/users/suscripciones');
    }
}
