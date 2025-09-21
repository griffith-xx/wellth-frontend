<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserPreferenceCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        if ($user->userPreference) {
            return $next($request);
        }

        $allowedRoutes = [
            'user-preferences.create',
            'user-preferences.store',
            'profile.show',
            'logout',
            'two-factor.login',
            'password.request',
            'password.reset',
            'verification.notice',
            'verification.verify',
            'verification.send'
        ];

        if (in_array($request->route()->getName(), $allowedRoutes)) {
            return $next($request);
        }

        return redirect()->route('user-preferences.create')->with('flash', [
            'message' => 'กรุณากรอกข้อมูลความต้องการของคุณเพื่อใช้งานระบบ',
            'style' => 'info',
        ]);
    }
}
