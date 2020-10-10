<?php

namespace App\Http\Middleware;

use Closure;
use App\Medicine;

class NepostojeciLijek
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
        // dd($request->all());
        if(!empty($request['brojLjekova'])) {
            // $request->request->remove('brojLjekova');
            $i = 0;
            $a = 0;
            $arr = [];
            $validationArr = [];
            foreach(request()->all() as $key => $value) {
                if(substr($key, 0, 3) != 'med' && substr($key, 0, 3) != 'kol') { continue; }
                $arr[$i][$key] = $value;
                $a += 0.5;
                $i = (int)floor($a);
                $validationArr[$key] = ['required', 'numeric', 'integer', 'gt:0'];
            }
            
            foreach($arr as $requestNiz) {
                if(!Medicine::all()->pluck('id')->contains(reset($requestNiz))) {
                    abort(403, 'Nije moguće napraviti račun jer dati lijek nije definisan');
                }
            }
            return $next($request);
        }
        if(!Medicine::all()->pluck('id')->contains($request->medicine_id)) {
            abort(403, 'Nije moguće napraviti račun jer dati lijek nije definisan');
        }
        return $next($request);
    }
}
