<?php

namespace App\Http\Middleware;

use App\Enum\ErrorCodes;
use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws ApiException
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->user()->role > (int) $role) :
            throw new ApiException(
                ErrorCodes::USER_FORBIDDEN,
                __('message.error.user_forbidden')
            );
        endif;

        return $next($request);
    }
}
