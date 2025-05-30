<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'family_name' => ['required', 'string', 'max:20'],
            'first_name' => ['required', 'string', 'max:20'],
            'family_name_kana' => ['required', 'string', 'max:20', 'regex:/^[\x{30A0}-\x{30FF}\x{30FC}]+$/u'],
            'first_name_kana' => ['required', 'string', 'max:20', 'regex:/^[\x{30A0}-\x{30FF}\x{30FC}]+$/u'],
            'sex' => ['required', 'in:1,2'],
            'year' => ['required', 'numeric', 'between:1900,' . date('Y')],
            'month' => ['required', 'numeric', 'between:1,12'],
            'day' => ['required', 'numeric', 'between:1,31'],
            'zip1' => ['required', 'digits:3'],
            'zip2' => ['required', 'digits:4'],
            'address' => ['required', 'string', 'max:255'],
            'tel1' => ['required', 'digits_between:1,5'],
            'tel2' => ['required', 'digits_between:1,5'],
            'tel3' => ['required', 'digits_between:1,5'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->whereNull('deleted_at'),],
            'password' => ['required', 'confirmed', 'min:8'],      
        ];
    }

    public function messages(): array
    {
        return [
            'family_name.required' => '姓を入力してください。',
            'first_name.required' => '名を入力してください。',
            'family_name.max' => '姓は20文字以内で入力してください。',
            'first_name.max' => '名は20文字以内で入力してください。',
            'family_name_kana.regex' => '姓(カナ)は全角カタカナで入力してください。',
            'first_name_kana.regex' => '名(カナ)は全角カタカナで入力してください。',
            'zip1.digits' => '郵便番号(上3桁)は3桁の数字で入力してください。',
            'zip2.digits' => '郵便番号(下4桁)は4桁の数字で入力してください。',
            'tel1.digits_between' => '電話番号の桁数が正しくありません。',
            'tel2.digits_between' => '電話番号の桁数が正しくありません。',
            'tel3.digits_between' => '電話番号の桁数が正しくありません。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.confirmed' => 'パスワードが一致しません。', 
            'password.min' => 'パスワードは8文字以上で入力してください。'
        ];
    }
}