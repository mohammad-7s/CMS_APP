<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Role hierarchy from lowest to highest
    protected array $levels = [
        'user'   => 1,
        'editor' => 2,
        'admin'  => 3,
    ];

    public function handle(Request $request, Closure $next, string $requiredRole): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        if (! isset($this->levels[$userRole]) || ! isset($this->levels[$requiredRole])) {
            abort(403, 'Not allowed');
        }

        // If the user's level is lower than required => deny
        if ($this->levels[$userRole] < $this->levels[$requiredRole]) {
            abort(403, 'Not allowed');
        }

        return $next($request);
    }
}



