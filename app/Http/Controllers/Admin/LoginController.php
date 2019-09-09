<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\AuthenticatesLogout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, AuthenticatesLogout {
        AuthenticatesLogout::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin',['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function username()
    {
        return 'username';
    }

    public function attemptLogin(Request $request)
    {
        $username = $request->input('username');

        $password = $request->input('password');

        // 验证用户名登录方式
        Log::info('Login1-:'.Auth::guard('admin')->check());
        $usernameLogin = Auth::guard('admin')->attempt(
            ['username' => $username, 'password' => $password]);
        if ($usernameLogin) {
            Log::info('Login2-:'.Auth::guard('admin')->check());
            return true;
        }

        // 验证手机号登录方式
        $mobileLogin = Auth::guard('admin')->attempt(
            ['phone' => $username, 'password' => $password]);

        if ($mobileLogin) {
            return true;
        }

        // 验证邮箱登录方式
        $emailLogin = Auth::guard('admin')->attempt(
            ['email' => $username, 'password' => $password]);

        if ($emailLogin) {
            return true;
        }
        Log::info('登陆失败');
        return false;

    }
}
