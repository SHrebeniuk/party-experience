<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;

class CheckAdmin
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
        $user = auth()->user();

        if($user->role_id == Role::ROLE_ADMIN) {
            return $next($request);
        }

        return redirect('/home');
    }
}
