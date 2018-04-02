<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->respond(null, '账号密码错误', 400);
        }

        $token = 'Bearer ' . $token;

        return $this->respond(compact('token'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {
        auth()->logout();

        return $this->respond(null, '注销成功');
    }
}
