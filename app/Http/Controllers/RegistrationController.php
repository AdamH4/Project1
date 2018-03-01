<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\User;
use GuzzleHttp\Client;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
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
                return redirect()->home();
            }
            else{
                return redirect('/registration');
            }
        }
        return redirect('/registration');
    }

    public function verify($token){
        $user = User::where('verify',$token)->firstOrFail();
        $user->update([
            'token'=> 0,
        ]);
        return redirect()->home();
    }
}
