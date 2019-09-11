<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        $response = $next($request);
        // $roles  = \DB::select("select * from rules");
        // foreach ($roles as $key => $value) {
            
        // }
        // dd($request);
        // echo auth()->user()->email;
        // die;
        return $response;
    }
}
