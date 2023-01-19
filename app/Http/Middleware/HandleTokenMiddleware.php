<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = OauthAccessToken::where('user_id', Auth::guard('hrd-api')->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if($token){
            if (Carbon::parse($token->expires_at) < Carbon::now()) {
                return response([
                    'status' => 401,
                    'data'  => false,
                    'message' => 'Token Expired',
                ], 401);
            }
        }

        return $next($request);
    }
}
