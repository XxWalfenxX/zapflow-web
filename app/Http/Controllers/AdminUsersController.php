<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AdminUsersController extends Controller
{
    public function create(): Response{
        return Inertia::render('Admin/AdminUsers', [
            'users' => DB::table('users')->get()
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request;

        DB::table('users')->delete($user -> id);

        return Redirect::to('/admin/users');
    }
}
