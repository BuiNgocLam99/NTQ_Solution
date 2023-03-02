<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SignUpController extends Controller
{
    public function index()
    {
        return view('user.signUp');
    }

    public function postSignUp(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'username' => 'required',
                'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
            ],
            [
                'required' => 'This field is required',
                'min' => 'Must be at least 8 character long',
                'regex' => 'At least 1 upperacse, 1 lowercase'
            ]
        );

        $account = [
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
        ];

        Session::push('accountList', $account);

        dd(Session::get('accountList'));

        return redirect()->route('user.post-sign-in')->with(['message' => 'Sign up successfully!']);
    }
}
