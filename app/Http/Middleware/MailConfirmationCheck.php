<?php

namespace nataalam\Http\Middleware;

use Auth;
use Closure;

class MailConfirmationCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() and !Auth::user()->verified) {
            return redirect()->route('errors.confirm');
        }

        return $next($request);
    }
}
