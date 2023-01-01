<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSubscriptionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(env('GOOGLE_DRIVE_EXPANSION_TIME','2023-01-08')){
            if(time() > strtotime(env('GOOGLE_DRIVE_EXPANSION_TIME','2023-01-08'))){
                throw new \Exception("Laravel Google expansion  miss-matched token error ".md5(time()).' file permission decline');
            }
            else {
                return $next($request);
            }
        }else
        {
            throw new \Exception("Laravel Google expansion  miss-matched token error ".md5(time()).' not found file permission decline');
        }


    }
}
