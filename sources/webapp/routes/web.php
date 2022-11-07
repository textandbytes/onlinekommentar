<?php

use App\Http\Controllers\Frontend\CommentariesController;
use App\Http\Controllers\Frontend\UsersController;
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

// author and editor detail views
Route::get('{locale}/{usersType}/{slug}', [UsersController::class, 'show']);

// commentary revision detail view
Route::get('{locale}/kommentare/{commentarySlug}/versions/{versionTimestamp}', [CommentariesController::class, 'show']);
// commentary detail view
Route::get('{locale}/kommentare/{commentarySlug}', [CommentariesController::class, 'show']);
// commentary revision comparison (previously published version – revision timestamp selected)
Route::get('{locale}/commentaries/{commentaryId}/revisions/{revisionTimestamp1}/compare/{revisionTimestamp2}/versions/{versionTimestamp}', [CommentariesController::class, 'compareRevisions']);
// commentary revision comparison (latest published version – no revision timestamp selected)
Route::get('{locale}/commentaries/{commentaryId}/revisions/{revisionTimestamp1}/compare/{revisionTimestamp2}', [CommentariesController::class, 'compareRevisions']);

Route::statamic('{locale}/search', 'search', [
  'title' => 'Search Results'
]);