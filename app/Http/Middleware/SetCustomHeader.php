<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Cookie;

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
        $response->header('Cache-Control', 'max-age=31536000');

        if(!starts_with(request()->path(), 'api') && !in_array($response->getStatusCode(), ['404'])){

            $response->headers->setCookie(
                new Cookie('XSRF-TOKEN',
                    $request->session()->token(),
                    time() + 60 * 120,
                    '/',
                    null,
                    true,
                    true)
            );
        }


        return $response;
    }
}
