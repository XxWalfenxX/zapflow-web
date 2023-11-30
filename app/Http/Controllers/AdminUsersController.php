<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
