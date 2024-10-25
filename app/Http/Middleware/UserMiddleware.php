<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $blog = $request->route('blog');

        if ($user->role === 'admin' || ($blog && $blog->user_id === $user->id)) {
            return $next($request);
        }

        return redirect()->route('blogs.index')->with('error', 'Unauthorized access.');
    }
}
