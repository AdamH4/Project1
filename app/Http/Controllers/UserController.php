<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
class UserController extends Controller
{
    public function index(){
        return view('shop.user.change');
    }

    public function reset(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $this->validate(request(),[
            'current-password' => 'required',
            'new-password' => 'required|confirmed|min:5',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->home()->with("success","Password changed successfully !");
    }

    public function indexInformation(){
        $id = auth()->user()->id;
        $add = User::hasInformation($id);
        return view('shop.user.information',compact('add'));
    }

    public function update(){
        $id = auth()->user()->id;
        $this->validate(request(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'city'=>'required',
            'street'=>'required',
            'postcode'=>'required|numeric',
            'country'=>'required',
            'phone_number'=>'required|numeric',
        ]);
        User::addInformation($id);
        return redirect()->home()->with('added_information');
    }

    public function delete(){
        $id = auth()->user()->id;
        User::deleteInformation($id);
        return redirect()->home();
    }
}
