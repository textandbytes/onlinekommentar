<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of authors.
     *
     * @return \Illuminate\Http\Response
     */
    public function authors()
    {
        return Inertia::render('Frontend/Authors', [
            'title' =>  __('authors'),
            'authors' => $this->_getUsersWithCommentariesByRole('author'),
            'documents' => $this->_getDocuments(),
            'activeDocument' => 'Strafprozessordnung'
        ]);
    }

    /**
     * Display a listing of editors.
     *
     * @return \Illuminate\Http\Response
     */
    public function editors()
    {
        return Inertia::render('Frontend/Editors', [
            'title' =>  __('editors'),
            'editors' => $this->_getUsersWithCommentariesByRole('editor'),
            'documents' => $this->_getDocuments(),
            'activeDocument' => 'Obligationenrecht'
        ]);
    }

    /**
     * Display a specific author.
     *
     * @param  String  $locale
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function author($locale, User $user)
    {
        return Inertia::render('Frontend/User', [
            'title' => $user->name,
            'user' => $user,
            'parentComponent' => 'Frontend/Authors'
        ]);
    }

    /**
     * Display a specific editor.
     *
     * @param  String  $locale
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editor($locale, User $user)
    {
        return Inertia::render('Frontend/User', [
            'title' => $user->name,
            'user' => $user,
            'parentComponent' => 'Frontend/Editors'
        ]);
    }

    private function _getUsersWithCommentariesByRole($roleName)
    {
        return User::with(['commentaries' => function ($query) use ($roleName) {
                $query
                    ->where('role_id', '=', Role::where('name', $roleName)->first()->id)
                    ->select('commentary_id as id', 'label_de');
            }])
            ->get(['id', 'name', 'title', 'occupation', 'practice', 'linkedin_url', 'website_url', 'profile_photo_path'])
            ->filter(function ($user) {
                return count($user->commentaries) > 0;
            })
            ->flatten()
            ->toArray();
    }

    private function _getDocuments()
    {
        return [
            'Bundesverfassung',
            'Obligationenrecht',
            'Bundesgesetz über das Internationale Privatrecht',
            'Lugano-Übereinkommen',
            'Strafprozessordnung',
        ];
    }
}