<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('user.resetPassword');
    }

    public function postResetPassword(Request $request)
    {
        $email = $request->email;
        $mailable = new ResetPasswordMail($email, '11111');
        Mail::to($email)->send($mailable);
        return true;
    }
}
