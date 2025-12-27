<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
         if (
            $request->is('admin*') ||
            $request->is('api*') ||
            $request->routeIs(
                'show.login',
                'admin.login',
                'logout'
            )
        ) {
            return $next($request);
        }

        if (setting('maintenance_mode') == 'true') {
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
