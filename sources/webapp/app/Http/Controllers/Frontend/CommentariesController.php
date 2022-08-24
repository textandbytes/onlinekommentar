<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Commentary;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commentaries = Commentary::all('id', 'slug', 'label_' . app()->getLocale())->toArray();

        return Inertia::render('Frontend/Commentaries', [
            'commentaries' => $commentaries
        ]);
    }
}
