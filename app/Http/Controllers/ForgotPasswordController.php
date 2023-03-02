<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('user.forgotPassword');
    }

    public function postForgotPassword (Request $request)
    {
        $email = $request->email;

        $accountList = (array) Session::get('accountList');
        
        for ($i = 0; $i < count($accountList); $i++) {
            if ($accountList[$i]['email'] == $email) {
                $newPassword = Str::random(10);
                $mailable = new ForgotPasswordMail($newPassword);
                Mail::to($email)->send($mailable);

                $accountList[$i]['password'] = bcrypt($newPassword);

                Session::put('accountList', $accountList);

                return redirect()->route('user.sign-in')->with('success_message', 'Your mail have been seending to your email!');
            }
        }
        return redirect()->route('user.forgot-password')->with('error_message', 'Your email is not exists in our records!');
    }
}
