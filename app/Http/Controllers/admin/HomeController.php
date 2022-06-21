<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function UserIndex(){
        return view('pages.home');
    }


    public function UserLogout(){
        Auth::logout();
        return view('pages.index');
    }
}
