<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // save the locale stored in the session if it exists; otherwise save the fallback locale
        $locale = session('locale') ?: config('app.fallback_locale');

        // use the original cms or auth urls
        if ($request->is('cms*') || $request->is('auth/*') || $request->is('js/*') || $request->is('svg/*') || $request->is('img/*')) {
            // save the locale in the session
            session(['locale' => config('app.fallback_locale')]);
            
            // set the locale application-wide so the correct translation file is loaded
            app()->setLocale(config('app.fallback_locale'));

            return $next($request);
        }

        // prepend locale to frontend urls
        if ($request->method() === 'GET') {
            $urlLocale = $request->segment(1);

            // prepend locale if the first segment in the url is not in the list of supported languages
            if (!in_array($urlLocale, config('app.locales'))) {
                $segments = $request->segments();
                array_unshift($segments, $locale);

                return redirect()->to(implode('/', $segments) . ($request->getQueryString() ? ('?' . $request->getQueryString()) : ''));
            } else {
                $locale = $urlLocale;
            }
        }

        // save the locale in the session
        session(['locale' => $locale]);

        // set the locale application-wide so the correct translation file is loaded
        app()->setLocale($locale);

        return $next($request);
    }
}
