<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedToken = (string) config('services.admin_api_token');
        $providedToken = (string) $request->bearerToken();

        abort_if($expectedToken === '' || ! hash_equals($expectedToken, $providedToken), 403);

        return $next($request);
    }
}
