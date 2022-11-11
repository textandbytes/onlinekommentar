<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Statamic\Facades\Entry;
use Statamic\Facades\User;
use Statamic\View\View;
use Storage;

class UsersController extends Controller
{
    public function show($locale, $usersType, $slug)
    {
        // ensure that a valid users view exists based on the supplied segment
        abort_if(!in_array($usersType, ['autoren', 'herausgeber']), 404);

        // get the user with the given slug
        $user = User::query()
            ->where('slug', '=', $slug)
            ->first();

        abort_if(!$user, 404);

        // get the commentaries authored by the user
        $authoredCommentaries = $this->_getCommentariesAssignedToUser($locale, $user, 'assigned_authors');

        // get the commentaries edited by the user
        $editedCommentaries = $this->_getCommentariesAssignedToUser($locale, $user, 'assigned_editors');

        // compile list of fields to display on the user detail view
        $userData = [
            'name' => $user->name,
            'legal_domain' => Entry::query()
                ->where('collection', 'legal_domains')
                ->where('id', $user->value('legal_domain'))
                ->get()
                ->map(function ($legal_domain, $key) {
                    return [
                        'id' => $legal_domain->id,
                        'label' => trans($legal_domain->title)
                    ];
                })
                ->first(),
            'title' => $user->  { 'professional_title_' . $locale },
            'occupation' => $user->{ 'occupation_' . $locale },
            'practice' => $user->practice,
            'linkedin_url' => $user->linkedin_url,
            'website_url' => $user->website_url,
            'avatar' => $user->value('avatar') ? Storage::url('avatars/') . $user->value('avatar') : null,
            'authored_commentaries' => !empty($authoredCommentaries) ? $authoredCommentaries : null,
            'edited_commentaries' => !empty($editedCommentaries) ? $editedCommentaries : null
        ];

        // load the user detail view
        return (new View)
            ->template('users/show')
            ->layout('layout')
            ->with(array_merge([
                'locale' => $locale,
                'base_path_prefix' => '/' . $locale . '/' . $usersType
            ], $userData));
    }

    private function _getCommentariesAssignedToUser($locale, $user, $userFieldName)
    {
        return Entry::query()
            ->where('collection', 'commentaries')
            ->where('status', 'published')
            ->where('locale', $locale)
            ->where($userFieldName, '!=', null)
            ->get()
            ->flatMap(function ($commentary, $key) use ($user, $userFieldName) {
                return $commentary[$userFieldName]->map(function ($userObj, $key) use ($user, $commentary) {
                    if ($user['id'] === $userObj->id) {
                        return [
                            'id' => $commentary['id'],
                            'slug' => $commentary['slug'],
                            'title' => $commentary['title'],
                        ];
                    }
                })->toArray();
            })
            ->filter()
            ->toArray();
    }
}
