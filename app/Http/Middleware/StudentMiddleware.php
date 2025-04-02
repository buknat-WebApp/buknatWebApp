<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){

            //Librarian = 1, student = 0, teacher = 2, 3=superadmin

            if(Auth::user()->role == '0'){

                return $next($request);

            }else{
                return redirect(route('loginForm'));
            }

        }else{

            return redirect(route('loginForm'));

        }

    }
}
