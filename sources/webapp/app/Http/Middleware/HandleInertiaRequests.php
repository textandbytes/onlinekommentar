<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        /*
         * Share the abilities of the authenticated user with Inertia
         * components to support toggling of user interface elements 
         * using conditionals.
         * 
         *   e.g. v-if="$page.props.can['view-users']"
         * 
         */
        $abilities = [];
        if ($request->user()) {
            $user = User::find($request->user()->id);
            foreach($user->getAllPermissions() as $permission) {
                $abilities[$permission->name] = $user->can($permission->name);
            }
        }

        return array_merge(parent::share($request), [
            'is_cms' => function () use ($request) {
                return $request->is('cms') || $request->is('cms/*') || $request->is('user/*');
            },

            'can' => fn () => $abilities,

            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
