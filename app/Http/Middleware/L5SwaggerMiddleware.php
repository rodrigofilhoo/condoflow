<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use L5Swagger\ConfigFactory;
use Symfony\Component\HttpFoundation\Response;

class L5SwaggerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $configFactory = app(ConfigFactory::class);
        $documentation = 'default';
        
        $request->offsetSet('documentation', $documentation);
        $request->offsetSet('config', $configFactory->documentationConfig($documentation));
        
        return $next($request);
    }
}
