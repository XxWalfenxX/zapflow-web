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
            ->get()
        ]);
    }
}
