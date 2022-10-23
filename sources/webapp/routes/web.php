<?php

use App\Http\Controllers\Frontend\CommentariesController;
use Illuminate\Support\Facades\Route;

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
  return redirect('/de');
});

// commentary revision detail view
Route::get('{locale}/kommentare/{commentary}/versions/{versionTimestamp}', [CommentariesController::class, 'show']);
// commentary detail view
Route::get('{locale}/kommentare/{commentary}', [CommentariesController::class, 'show']);
// commentary revision comparison
Route::get('{locale}/commentaries/{commentary}/revisions/{revision1}/compare/{revision2}', [CommentariesController::class, 'compareRevisions']);

Route::statamic('{locale}/search', 'search', [
  'title' => 'Search Results'
]);