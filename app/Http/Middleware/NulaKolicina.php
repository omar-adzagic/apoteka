<?php

namespace App\Http\Middleware;

use Closure;

class NulaKolicina
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
        if($request['medicine']->kolicina == 0) {
            abort(403, 'Nije moguće napraviti račun za lijek sa količinom 0 na stanju');
        }
        return $next($request);
    }
}
