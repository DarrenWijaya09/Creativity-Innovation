<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // return $next($request);

        if(!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role;

        switch($role) {
            case 'admin':
                if($authUserRole == 0) {
                    return $next($request);
                }
                break;
            case 'seller':
                if($authUserRole == 1) {
                    return $next($request);
                }
                break;
            case 'customer':
                if($authUserRole == 2) {
                    return $next($request);
                }
                break;
        }

        switch($authUserRole) {
            case 0:
                return redirect()->route('admin');
            case 1:
                return redirect()->route('seller.dashboard');
            case 2:
                return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
