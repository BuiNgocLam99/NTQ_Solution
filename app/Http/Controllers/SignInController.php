<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SignInController extends Controller
{
    public function index()
    {
        return view('user.signIn');
    }

    public function postSignIn(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
            ],
            [
                'required' => 'This field is required',
                'min' => 'Must be at least 8 character long',
                'regex' => 'At least 1 upperacse, 1 lowercase'
            ]
        );

        $username = $request->username;
        $password = $request->password;

        $old_username = Session::get('username');
        $old_password = Session::get('password');

        if ($username == $old_username && $password == $old_password) {
            return redirect()->back()->with('success_message', 'Sign in successfully!');
        } else {
            return redirect()->back()->with('error_message', 'Username or Password is wrong!');
        }
    }
}
