<?php

namespace App\Http\Middleware;

use Closure;

class MyMiddelware
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
        if($request->has('diem') && $request['diem'] > 4){
            return $next($request);
        }elseif($request->has('diem') && $request['diem'] < 4){
            return redirect()->route('kodat');
        }else return redirect()->route('loi');
        
    }
}
