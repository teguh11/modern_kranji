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

    private $abilities = [
        'index' => 'list',
        'edit' => 'update',
        'show' => 'view',
        'update' => 'update',
        'create' => 'create',
        'store' => 'create',
        'destroy' => 'delete',
        'addpermission' => 'addpermission',
        'storepermission' => 'addpermission'
    ];

    public function handle($request, Closure $next)
    {
        
        // $routeName = explode('.', \Request::route()->getName());
        // dd($routeName);
        // $action = array_get($this->getAbilities(), $method);
        // dd($action);
        // return $action ? $action . '-' . $routeName[0] : null;

        // $response = $next($request);
        // dd("testx");
        // return $response;
        // dd("test");
        return $next($request);
    }
}
