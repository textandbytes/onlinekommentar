<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    /**
     * Display a listing of editors.
     *
     * @return \Illuminate\Http\Response
     */
    public function editors()
    {
        $editors = User::has('editedCommentaries')
            ->with(['editedCommentaries' => function ($query) {
                $query->select('commentary_id as id', 'label_de');
            }])
            ->get(['id', 'name', 'title', 'linkedin_url', 'website_url', 'profile_photo_path'])
            ->flatten()
            ->toArray();

        return Inertia::render('Frontend/Editors', [
            'editors' => $editors
        ]);
    }
}