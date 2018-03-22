<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\User;
use GuzzleHttp\Client;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('verify');
    }

    public function index(){
        return view('shop.registration.create');
    }

    public function store(RegistrationForm $form){
        $token = request('g-recaptcha-response');
        if ($token){
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify',[
                'form_params' => array(
                    'secret' => '6LcFekYUAAAAAAO_93u1w-YYNe34y6mXriP0KCtu',
                    'response' => $token,
                    )
            ]);
            $result = json_decode($response->GetBody()->getContents());
            if ($result->success){
                $form->persist();
                session()->flash('success_registration');
                return redirect()->home();
            }
            else{
                return redirect('/registration');
            }
        }
        return redirect('/registration');
    }

    public function verify($token){
        $user = User::where('token',$token)->firstOrFail();
        $user->update([
            'token'=> null,
        ]);
        session()->flash('success_verify');
        return redirect()->home();
    }
}
