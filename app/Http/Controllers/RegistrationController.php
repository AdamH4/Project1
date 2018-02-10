<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function index(){

        return view('shop.registration.create');
    }

    public function store(RegistrationForm $form){

        $form->persist();

        return redirect()->home();
    }
}
