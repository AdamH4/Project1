<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('shop.login.create');
    }

    public function create(){
        if(! auth()->attempt(request(['email' ,'password']))) {
            return redirect()->back()->with('unsuccess_message','Wrong password or email');
        }
        session()->flash('success_login');
        return redirect()->home();
    }

    public function logout(){
        auth()->logout();
        session()->flash('success_logout');
        return redirect()->home();
    }
}
