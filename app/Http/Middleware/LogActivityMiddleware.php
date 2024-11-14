<?php

namespace App\Http\Middleware;

use App\Models\LogActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            LogActivity::create([
                'user_id' => Auth::id(),
                'model_type' => null,
                'model_id' => null,
                'show' => $request->path(),
                'data' => json_encode($request->all()),
                'activity' => 'Mengakses URL ' . $request->path(),
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'agent' => $request->header('User-Agent'),
                'ip' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}
