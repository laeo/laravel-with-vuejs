<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 标准响应体生成器
     *
     * @param  mixed   $payload 接口响应主体数据
     * @param  string  $message 附加对状态的描述消息
     * @param  integer $status  HTTP状态码
     *
     * @return \Response
     */
    public function respond($payload, $message = 'OK', $status = 200)
    {
        return response()->json(compact('message', 'payload'), $status);
    }
}
