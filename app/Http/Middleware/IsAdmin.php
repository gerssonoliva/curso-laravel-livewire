<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->is_admin == 0) {
            // return $next($request);
            return redirect()->route('home');
        } /* else {
            abort(403, 'Unauthorized');
        } */
        return $next($request);
    }
}
