<?php

namespace App\Http\Middleware;

use App\Services\User\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthUserRole
{
    public function __construct(protected UserService $userService)
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $role = null): Response
    {
        if (!$role || !auth()->check()) {
            return redirect('/');
        }

        if (!$this->userService->hasRole(auth()->id(), $role)) {
            return redirect('/');
        }

        return $next($request);
    }
}
