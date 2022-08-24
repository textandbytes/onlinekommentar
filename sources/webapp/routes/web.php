<?php

use App\Http\Controllers\Cms\CommentariesController;
use App\Http\Controllers\Cms\DocumentTreeController;
use App\Http\Controllers\Cms\UsersController;
use App\Http\Controllers\Frontend\CommentariesController as CommentariesControllerFrontend;
use App\Http\Controllers\Frontend\DocumentTreeController as DocumentTreeControllerFrontend;
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

// frontend routes
Route::group(['prefix' => '{locale?}', 'where' => ['locale' => implode('|', Config::get('app.locales'))], 'middleware' => ['web']], function() {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('Home');

    // commentaries
    Route::get('kommentare', [CommentariesControllerFrontend::class, 'index']);

    // about
    Route::get('/ueber-onlinekommentar', function () {
        return Inertia::render('About');
    })->name('About');

    // contact
    Route::get('/contact', function () {
        return Inertia::render('Contact');
    })->name('Contact');

    Route::get('/tree', [DocumentTreeControllerFrontend::class, 'index']);
});

// cms routes
Route::prefix('cms')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('cms');

    Route::resource('tree', DocumentTreeController::class);

    Route::resource('users', UsersController::class);

    Route::resource('commentaries', CommentariesController::class);
});

