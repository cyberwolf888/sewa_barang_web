<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Role
{
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
    public function handle($request, Closure $next, $roles)
    {
        if ($this->auth->check()) {
            foreach (explode('|', $roles) as $role){
                if (\Auth::user()->can($role)) {
                    return $next($request);
                }
            }
        }
        return redirect(url('/'));
    }
}
