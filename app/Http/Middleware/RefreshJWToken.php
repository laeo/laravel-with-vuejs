<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;

class RefreshJWToken
{
    /**
     * 标记是否需要执行刷新操作
     *
     * @var boolean
     */
    private $shouldRefresh = false;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //检查是否存在Token
        try {
            auth()->setRequest($request)->parseToken();

            //检查Token是否有效
            if (false === auth()->check()) {
                //Token无效所以对请求进行标记
                $this->shouldRefresh = true;
            }

        } catch (JWTException $e) {
            //无Token所以跳过操作
        }

        //取得响应数据
        $response = $next($request);

        if ($this->shouldRefresh) {
            $this->refreshJWToken($response);
        }

        return $response;
    }

    private function refreshJWToken($response)
    {
        //添加新的Token到响应头信息中
        $response->header('Authorization', auth()->refresh());
    }
}
