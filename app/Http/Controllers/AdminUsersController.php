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

class AdminUsersController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/AdminUsers', [
            'users' => DB::table('users')->get()
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request;

        DB::table('asignar')->where('id_user', $user->id)->delete();
        DB::table('cargar')->where('id_user', $user->id)->delete();
        DB::table('tener')->where('id_user', $user->id)->delete();
        DB::table('users')->delete($user->id);

        return Redirect::to('/admin/users');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach(1);

        event(new Registered($user));

        return Redirect::to('/admin/users');
    }

    public function udpate(Request $request): RedirectResponse
    {
        if ($request->password == null || $request->password == '') {
            DB::table('users')
                ->where('id', $request->id)
                ->update(['name' => $request->name, 'email' => $request->email, 'updated_at' => DB::raw('CURRENT_TIMESTAMP()')]);
        } else {
            DB::table('users')
                ->where('id', $request->id)
                ->update(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'updated_at' => DB::raw('CURRENT_TIMESTAMP()')]);
        }

        return Redirect::to('/admin/users');
    }
}
