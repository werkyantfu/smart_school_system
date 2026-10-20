<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * This checks if the logged-in user has the correct role.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Check if the user is logged in
        if (!$request->user()) {
            return response()->json([
                'message' => 'Please login first (Unauthorized)'
            ], 401);
        }

        // 2. Check if the user's role is in the allowed list
        if (!in_array($request->user()->role, $roles)) {
            return response()->json([
                'message' => 'You do not have permission to do this (Forbidden)'
            ], 403);
        }

        // 3. If everything is okay, let the request continue
        return $next($request);
    }
}