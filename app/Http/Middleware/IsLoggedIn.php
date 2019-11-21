<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;


class IsLoggedIn
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
        try {
            $token = str_replace('Bearer ', '', $request->header('Authorization'));
            $payload = JWT::decode($token, env('SECRET_TOKEN_KEY', 'Pesen.In'), ['HS256']);
            $request->loggedin_email = $payload->email;

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Unauthorized",
            ], 401);
        }
    }
}
