<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
        if(! $request->expectsJson()) {
            if($request->routeIs('author.*')){
                Session::flash('fail', 'You must sign in first');
                return route('author.login', ['fail' => true, 'returnUrl' => URL::current()]);
            }
        }
    }
}
