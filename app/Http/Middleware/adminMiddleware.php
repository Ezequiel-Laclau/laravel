<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class adminMiddleware
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
        if(Auth::user()->email==="admin@admin.com"){
            return $next($request);
        }else{
            return redirect("/inicio");
        }
    }
}
