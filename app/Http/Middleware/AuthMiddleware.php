<?php

namespace App\Http\Middleware;

// use App\Models\Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && Auth::user()->role_id == 2) {
            return $next($request);
        }

        return redirect()->route('post')->with('error_role', 'Yêu cầu quyền không hợp lệ. Bạn không có quyền ADMIN truy cập');
    }
}
