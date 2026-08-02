<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;
        $superVisorId = Role::where('role_name', 'supervisor')->first()->id;

        if ($role_id !== $superVisorId) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
