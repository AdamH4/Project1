<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\User;
use GuzzleHttp\Client;
use App\Notifications\Verify;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('verify');
    }

    public function index(){
        return view('shop.registration.create');
    }

    public function store(){
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
                $this->validate(request(),[
                    'name'=>'required',
                    'email'=>'required|email',
                    'password'=>'required|confirmed|min:5',
                    'check'=>'required',
                ]);
                $user = User::create([
                    'token'=>str_random(40),
                    'name'=>request('name'),
                    'email'=>request('email'),
                    'password'=>bcrypt(request('password')),
                ]);
                $user->notify(new Verify($user));
                \Auth::login($user);
                session()->flash('success_registration');
                return redirect()->home();
            }
        }
        session()->flash('no_recaptcha');
        return view('shop.registration.create');
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
