<?php

namespace App\Http\Requests;

use App\Mail\welcome;
use Illuminate\Foundation\Http\FormRequest;
use App\User;

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
            'password'=>bcrypt(request('password'))
        ]);
        \Mail::to($user)->send(new welcome($user));
        \Auth::login($user);
    }
}