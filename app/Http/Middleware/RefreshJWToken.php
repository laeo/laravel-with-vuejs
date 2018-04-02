<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshJWToken extends BaseMiddleware
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
        //检查Token，不存在直接放行
        if (false === $this->auth->parser()->setRequest($request)->hasToken()) {
            return $next($request);
        }

        try {
            //检查Token是否有效
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
        } catch (TokenExpiredException $e) {
            //Token已过期，尝试自动刷新
            try {
                $token = $this->auth->refresh();
                // Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
                Auth::guard('api')->setToken($token);

                return $this->setAuthenticationHeader($next($request), $token);
            } catch (JWTException $e) {
                //自动刷新失败，响应401
                throw new UnauthorizedHttpException('Authorization', $e->getMessage());
            }
        }
    }
}
