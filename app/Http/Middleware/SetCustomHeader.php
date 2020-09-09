<?php

namespace App\Http\Middleware;

use Closure;

class SetCustomHeader
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
        $response =$next($request);
        $response->header('Content-Security-Policy', "default-src 'self' 'unsafe-eval' 'unsafe-inline' *.nitve-ecommerce.com; script-src 'self' 'unsafe-inline' 'unsafe-eval'; img-src 'self' *.nitve-ecommerce.com data:; connect-src 'self' *.nitve-ecommerce.com; font-src 'self' *.nitve-ecommerce.com report-uri *.nitve-ecommerce.com/csp_report; form-action 'self'");
        $response->header('Cache-Control', 'no-store');
        return $response;
    }
}
