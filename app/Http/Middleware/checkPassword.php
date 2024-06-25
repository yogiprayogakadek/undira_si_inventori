<?php

namespace App\Http\Middleware;

use App\Models\Pengguna;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class checkPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentPassword = '12345678'; // The password to check against

        $pengguna = Pengguna::find(Auth::id());

        if (Hash::check($currentPassword, $pengguna->password)) {
            return response()->view('error.password-change', [], 403);
        }

        return $next($request);
    }
}
