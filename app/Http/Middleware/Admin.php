<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user === null || $user->role !== 'admin') {
            return response()->json(['Unauthorized, user is not admin'], 401);
        }
        return $next($request);
    }
}
