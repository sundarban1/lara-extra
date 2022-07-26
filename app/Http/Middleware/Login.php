<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Login
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

        $userId =  Session::get('user_id');

        

        if (!isset($userId)) {

            echo 'user is not login';
            exit;
        }

       $user=  User::find($userId);

       if($user->role != 'admin'){
        echo 'you are not admin';
        exit;
       }



        return $next($request);
    }
}
