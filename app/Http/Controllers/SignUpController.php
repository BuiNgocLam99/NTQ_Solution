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
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ];

        $accountList = (array) Session::get('accountList');

        for($i = 0; $i < count($accountList); $i++){
            if($account['username'] == $accountList[$i]['username'] || $account['email'] == $accountList[$i]['email']){
                return redirect()->route('user.post-sign-up')->with(['error_message' => 'Your email or username has been existed!']);
            }
        }

        array_push($accountList, $account);

        Session::put('accountList', $accountList);

        return redirect()->route('user.post-sign-in')->with(['success_message' => 'Sign up successfully!']);
    }
}
