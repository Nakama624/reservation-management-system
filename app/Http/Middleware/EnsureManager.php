<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function manager($request, Closure $next)
    {
        if (!$request->user()->is_manager) {
            return response()->json([
                'message' => '権限がありません',
            ], 403);
        }

        return $next($request);
    }
}
