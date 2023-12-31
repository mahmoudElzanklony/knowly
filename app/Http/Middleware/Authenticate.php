<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if($jwt = $request->cookie('jwt')){
            $request->headers->set('Authorization' , 'Bearer '.$jwt);
        }

        if (isset($request->api_token)) {
            $request->headers->set('Authorization' , 'Bearer '.$request->api_token);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
