<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // nếu user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();
            return $next($request);
            // nếu level =1 (admin), status = 1 (actived) thì cho qua.
            // if ($user->level == 1 && $user->status == 1 ) {
            //     return $next($request);
            // } else {
            //     Auth::logout();
            //     return redirect()->route('getLogin');
            // }
        } else {
            return redirect()->route('admin.getLogin');
        }
    }
}
