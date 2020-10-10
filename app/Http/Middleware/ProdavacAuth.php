<?php

namespace App\Http\Middleware;

use Closure;

class ProdavacAuth
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
        if(auth()->user()->role->name == 'Prodavac') {
            abort(403, 'Pristup Nije Dozvoljen Prodavcu');
        }
        return $next($request);
    }
}
