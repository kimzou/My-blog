<?php

namespace App\Http\Middleware;

use Closure;

class Blogger
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
        $user = $request->user();
        
        if ($user && ($user->role === 'blogger' || $user->role === 'admin')) {
            return $next($request);
        }
        
        return redirect()->back();    
    }
}
