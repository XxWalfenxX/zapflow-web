<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminUsersCarVehController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminUserCarVeh', [
            'userSubs' => DB::table('cargar')
                ->join('users', 'id_user', '=', 'users.id')
                ->join('puntos_carga', 'id_punto_carga', '=', 'puntos_carga.id')
                ->select('cargar.*', 'users.email', 'puntos_carga.ubicacion')
                ->get(),

            'bonosAvail' => DB::table('puntos_carga')->select('id', 'ubicacion')->get(),
            'usersAvail' => DB::table('users')->select('id', 'email')->get()
        ]);
    }

    public function udpate(Request $request): RedirectResponse
    {
        // Obtener los bonos actuales del usuario desde la base de datos
        $bonosActuales = DB::table('cargar')->where('id_user', '=', $request->id_user)->pluck('id_punto_carga')->toArray();

        // Obtener los bonos proporcionados en la solicitud
        $nuevosBonos = $request->input('id_bonos', []);

        // Identificar los bonos a eliminar (están en $rolesActuales pero no en $nuevosRoles)
        $bonosEliminar = array_diff($bonosActuales, $nuevosBonos);

        // Identificar los bonos a agregar (están en $nuevosRoles pero no en $rolesActuales)
        $bonosAgregar = array_diff($nuevosBonos, $bonosActuales);

        // Eliminar bonos que ya no están presentes
        if (!empty($bonosEliminar)) {
            DB::table('cargar')->where('id_user', '=', $request->id_user)->whereIn('id_punto_carga', $bonosEliminar)->delete();
        }

        // Agregar nuevos bonos
        foreach ($bonosAgregar as $rol) {
            DB::table('cargar')->insert(['id_user' => $request->id_user, 'id_punto_carga' => $rol]);
        }

        return Redirect::to('/admin/users/carga-vehiculos');
    }

    public function store(Request $request): RedirectResponse
    {
        $result = DB::table('cargar')->where('id_user', $request->idUser)->where('id_punto_carga',$request->idBono)->first();

        if ($result) {
            return redirect(url()->previous())
                    ->withErrors('El usuario ya está asignado a ese punto')
                    ->withInput();
        } else {
            DB::table('cargar')->insert(
                ['id_user' => $request->idUser, 'id_punto_carga' => $request->idBono]
            );
        }

        return Redirect::to('/admin/users/carga-vehiculos');
    }
}
