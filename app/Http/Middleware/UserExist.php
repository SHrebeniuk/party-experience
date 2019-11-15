<?php

namespace App\Http\Middleware;

use Closure;
use App\Team;

class UserExist
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
        $team = Team::where(['title' => $request->title])->first();

        if(auth()->user()->team_id == $team->id) {
            return $next($request);
        }

        return redirect('/teams');
    }
}
