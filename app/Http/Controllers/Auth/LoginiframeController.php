<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginiframeController extends Controller
{
    //
    public function login(){
        return view('auth.loginiframe');
    }
}
