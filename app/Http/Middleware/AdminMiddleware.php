<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!empty(auth()->user())) {
            $access = User::where('name', auth()->user()->name)->first();
            // return $access;
            if ($access->name == 'wisnu') {
                return $next($request);
            } else {
                return redirect()->route('index.pegawai');
            }
        } else {
            return redirect()->route('index.pegawai');
        }
        //return $next($request);
    }
}