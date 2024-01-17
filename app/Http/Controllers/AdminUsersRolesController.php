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

class AdminUsersRolesController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminUserRoles', [
            'userRoles' => DB::table('asignar')
                ->join('users', 'id_user', '=', 'users.id')
                ->join('roles', 'id_roles', '=', 'roles.id')
                ->select('asignar.*', 'users.email', 'roles.nombre')
                ->get(),

            'roles' => DB::table('roles')->get()
        ]);
    }

    public function udpate(Request $request): RedirectResponse
    {
        // Obtener los roles actuales del usuario desde la base de datos
        $rolesActuales = DB::table('asignar')->where('id_user', '=', $request->id_user)->pluck('id_roles')->toArray();

        // Obtener los roles proporcionados en la solicitud
        $nuevosRoles = $request->input('id_roles', []);

        // Identificar los roles a eliminar (están en $rolesActuales pero no en $nuevosRoles)
        $rolesEliminar = array_diff($rolesActuales, $nuevosRoles);

        // Identificar los roles a agregar (están en $nuevosRoles pero no en $rolesActuales)
        $rolesAgregar = array_diff($nuevosRoles, $rolesActuales);

        // Eliminar roles que ya no están presentes
        if (!empty($rolesEliminar)) {
            DB::table('asignar')->where('id_user', '=', $request->id_user)->whereIn('id_roles', $rolesEliminar)->delete();
        }

        // Agregar nuevos roles
        foreach ($rolesAgregar as $rol) {
            DB::table('asignar')->insert(['id_user' => $request->id_user, 'id_roles' => $rol]);
        }

        return Redirect::to('/admin/users/roles');
    }
}
