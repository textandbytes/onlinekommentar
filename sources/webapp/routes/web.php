<?php

use App\Http\Controllers\Cms\CommentariesController;
use App\Http\Controllers\Cms\DocumentTreeController;
use App\Http\Controllers\Cms\UsersController;
use App\Http\Controllers\Frontend\CommentariesController as CommentariesControllerFrontend;
use App\Http\Controllers\Frontend\DocumentTreeController as DocumentTreeControllerFrontend;
use App\Http\Controllers\Frontend\UsersController as UsersControllerFrontend;
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
    // home
    Route::get('/', function () {
        return Inertia::render('Frontend/Home');
    })->name('Frontend/Home');

    // commentaries
    Route::get('/kommentare', [CommentariesControllerFrontend::class, 'index'])->name('Frontend/Commentaries');
    Route::get('/kommentare/{commentary:slug}', [CommentariesControllerFrontend::class, 'show'])->name('Frontend/Commentary');

    // authors
    Route::get('/autoren', [UsersControllerFrontend::class, 'authors'])->name('Frontend/Authors');

    // editors
    Route::get('/herausgeber', [UsersControllerFrontend::class, 'editors'])->name('Frontend/Editors');

    // about
    Route::get('/ueber-onlinekommentar', function () {
        return Inertia::render('Frontend/About');
    })->name('Frontend/About');

    // contact
    Route::get('/kontakt', function () {
        return Inertia::render('Frontend/Contact');
    })->name('Frontend/Contact');

    // document tree
    Route::get('/tree', [DocumentTreeControllerFrontend::class, 'index']);
});

// cms routes
Route::prefix('cms')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Cms/Dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        return Inertia::render('Cms/Dashboard');
    })->name('cms');

    Route::resource('tree', DocumentTreeController::class);

    Route::resource('users', UsersController::class);

    Route::resource('commentaries', CommentariesController::class);
});