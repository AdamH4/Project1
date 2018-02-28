<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Notifications\Verify;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|',
            'email'=>'required|email',
            'password'=>'required|confirmed|min:5',
            'check'=>'required',
        ];
    }

    public function persist(){
        $user= User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>bcrypt(request('password')),
            'token'=> str_random(30),
        ]);

        \Auth::login($user);
    }
}