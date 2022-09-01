<?php

namespace nataalam\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use nataalam\Models\User;

class AdminFireWall
{


    /**
     * @var
     */
    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();
        if(!$user or !$user->is_admin)
            abort(403);
        return $next($request);
    }
}
