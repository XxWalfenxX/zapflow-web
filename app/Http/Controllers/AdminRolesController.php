<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminRoles', [
            'roles' => DB::table('roles')->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        DB::table('roles')->insertGetId(
            ['nombre' => $request->nombre]
        );

        return Redirect::to('/admin/roles');
    }

    public function udpate(Request $request): RedirectResponse
    {
        DB::table('roles')
                ->where('id', $request->id)
                ->update(['nombre' => $request->nombre]);

        return Redirect::to('/admin/roles');
    }


    public function destroy(Request $request): RedirectResponse
    {
        DB::table('asignar')->where('id_roles', $request->id)->delete();
        DB::table('roles')->delete($request->id);

        return Redirect::to('/admin/roles');
    }
}
