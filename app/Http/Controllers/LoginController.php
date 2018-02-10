<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest',['except'=>'logout']);
    }

    public function index(){

        return view('shop.login.create');
    }

    public function create(){

        if(! auth()->attempt(request(['email' ,'password'])))
        {
            return redirect()->back()->withInput(request()->only('email','remember'));
        }

        return redirect()->home();
    }

    public function logout(){

        auth()->logout();

        return redirect()->home();
    }
}
