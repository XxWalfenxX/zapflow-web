<?php

use App\Http\Controllers\AdminPuntosCargaController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserBonosController;
use App\Http\Controllers\UserBonosHistoryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('Inicio');



Route::get('/puntos', function () {
    return Inertia::render('PuntosCarga', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('puntocarga');

Route::get('/bonos', function () {
    return Inertia::render('Bonos', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('bonos');

Route::get('/contacto', function () {
    return Inertia::render('Contacto', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('contacto');

Route::get('/privacy', function () {
    return Inertia::render('Privacy', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('privacy');


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'create'])->name('dashboard');
    Route::get('/mis-vehiculos', function(){
        return Inertia::render('User/Vehiculos');
    })->name('vehiculos');
    Route::get('/mis-bonos', [UserBonosController::class, 'create'])->name('user.bonos');
    Route::get('/mis-compras', [UserBonosHistoryController::class, 'create'])->name('user.bonosComprados');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rutas accesibles solo para usuarios con el rol 'admin'
    Route::get('/admin', function () {
        return Inertia::render('Admin/AdminDashboard');
    })->name('admin');
    Route::get('/admin/users',[AdminUsersController::class, 'create'])->name('admin.users');
    Route::post('/admin/users',[AdminUsersController::class, 'store'])->name('admin.users.store');
    Route::patch('/admin/users',[AdminUsersController::class, 'udpate'])->name('admin.users.update');
    Route::delete('/admin/users', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/puntos-carga',[AdminPuntosCargaController::class, 'create'])->name('admin.puntosc');
});

require __DIR__ . '/auth.php';
