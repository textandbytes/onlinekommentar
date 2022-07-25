<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Request;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    return Inertia::render('Users/Index', [
      'users' => User::query()
        ->when(Request::input('search'), function ($query, $search) {
          $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(20)
        ->withQueryString()
        ->through(fn ($user) => [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          'profile_photo_url' => $user->profile_photo_url,
        ]),

      'filters' => Request::only(['search'])
    ]);
  }

}
