<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignInController extends Controller
{
    public function index()
    {
        // dd((array) Session::get('accountList'));
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

        $accountList = (array) Session::get('accountList');

        for ($i = 0; $i < count($accountList); $i++) {
            if ($username == $accountList[$i]['username'] && Hash::check($password, $accountList[$i]['password'])) {
                return redirect()->back()->with('success_message', 'Sign in successfully!');
            }
        }

        return redirect()->back()->with('error_message', 'Username or Password is wrong!');
    }
}
