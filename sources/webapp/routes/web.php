<?php

use App\Http\Controllers\DocumentTreeControllerFrontend;
use App\Http\Controllers\Cms\DocumentTreeController;
use App\Http\Controllers\Cms\UsersController;
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
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/about', function () {
    return Inertia::render('About', [
        
    ]);
});

Route::get('/contact', function () {
    return Inertia::render('Contact', []);
});


Route::get('/settings', function () {
    return Inertia::render('Settings', []);
});

Route::get('/tree', [DocumentTreeControllerFrontend::class, 'index']);

Route::prefix('cms')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('cms');

    Route::resource('tree', DocumentTreeController::class);

    Route::resource('users', UsersController::class);
});

