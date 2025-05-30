<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function confirm(Request $request)
    {
        //データをバリデーションして確認画面へ
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:2000',
        ]);

        return view('contact.confirm', [
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);
    }

    public function send(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
        $secret = config('services.recaptcha.secret');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
          'secret' => $secret,
          'response' => $token,  
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            return back()->with('error', 'reCAPTCHAでスパムの可能性が検出されました。');
        }

        //DBに保存
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        return redirect()->route('contact.complete')->with('status', 'お問い合わせを受け付けました。');
    }
}
