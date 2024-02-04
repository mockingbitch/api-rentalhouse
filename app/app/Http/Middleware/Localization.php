<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        //Check header request and set language default
        $lang = ($request->hasHeader('X-localization'))
            ? $request->header('X-localization')
            : 'vi';
        //Set laravel localization
        app()->setLocale($lang);

        //Continue request
        return $next($request);
    }
}
