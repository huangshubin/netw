<?php

namespace App\Http\Middleware;

use Closure;

class PermissionRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard='web')
    {
       $route= $request->route();
        $actions=$route->getAction();
        if ($permissions = !empty($actions['permissions']) ? $actions['permissions'] : null)
        {
           if(!$request->user($guard)->hasPermissions($permissions))
           {
               abort(401,'Unauthorized');
           }
        }
        return $next($request);
    }
}
