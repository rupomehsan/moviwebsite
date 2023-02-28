<?php

namespace App\Http\Middleware;

// use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminSettings
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
        //START:: Access for SuperAdmin
        if (auth()->check()) {
            $accessControllArr = json_decode(auth()->user()->access) ?? [];
            if ((!in_array('settings', $accessControllArr)) && (in_array(auth()->user()->user_role_id, [2]))) {
                return redirect('/');
            } else {

            }
        } else {
            return redirect('/');
        }
        //END:: Access for SuperAdmin

        return $next($request);
    }
}
