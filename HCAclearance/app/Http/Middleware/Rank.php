<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Rank
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,string $rank)
    {
        if($rank =='admin' && Auth::user()->rank != 'admin'){
            abort();
        }
        if($rank =='staff' && Auth::user()->rank !='staff'){
            abort();
        }
        if($rank =='student' && Auth::user()->rank !='student'){
            abort();
        }
        return $next($request);
    }
}
