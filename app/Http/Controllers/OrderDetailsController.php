<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function index()
    {
        return view('user.order_details');
    }
}
