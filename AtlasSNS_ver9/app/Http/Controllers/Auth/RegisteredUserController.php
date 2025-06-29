<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate(
            [
                'username' => 'required|max:12|min:2',
                'email' => 'required|max:40|min:5|unique:users,email|email',
                'password' => 'required|max:20|min:8|regex:/^[a-zA-Z0-9]+$/|confirmed'
            ],
            [
                'username.required' => 'ユーザー名は必須です',
                'username.max' => 'ユーザー名は12文字以内で入力してください',
                'username.min' => 'ユーザー名は2文字以上で入力してください',
                'email.required' => 'メールアドレスは必須です',
                'email.max' => 'メールアドレスは40文字以内で入力してください',
                'email.unique' => '登録済みのメールアドレスです',
                'email.email' => '正しいメールアドレスを入力してください',
                'password.required' => 'パスワードは必須です',
                'password.max' => 'パスワードは20文字以内で入力してください',
                'password.min' => 'パスワードは8文字以上で入力してください',
                'password.regex' => 'パスワードは英数字で入力してください',
            ]
        );

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $request->session()->put('key', $request->username);
        return redirect('added');
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
