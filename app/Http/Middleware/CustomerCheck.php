<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CustomerCheck
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
        if (Session::has('CustomerSession') == "") {
            return redirect('customer/login');
        }else{
            return redirect('/');
        }

        //return $next($request);
       
    }
}
