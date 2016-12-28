<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
   
    public function handle($request, Closure $next, $role)
    {
        if (\Auth::user()->can($role . '-access')) {
          return $next($request);
        }
        
        return response('blank', 404);
    }
}