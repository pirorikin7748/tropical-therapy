<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        //recaptcha検証
        $recaptchaResponse = $request->input('recaptcha_token');
        $secretKey = config('services.recaptcha.secret');

        $response = HTTP::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
           'secret' => $secretKey,
           'response' => $recaptchaResponse, 
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            return back()->withErrors(['recaptcha' => '不正なアクセスが検出されました。']);
        }

        //ログイン処理
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'ログインに失敗しました']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
