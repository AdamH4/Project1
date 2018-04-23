<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('shop.user.change');
    }

    public function reset(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            session()->flash('wrong_password');
            return redirect()->back();
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            session()->flash('same_password');
            return redirect()->back();
        }
        $this->validate(request(),[
            'current-password' => 'required',
            'new-password' => 'required|confirmed|min:5',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        session()->flash('change_password');
        return redirect()->home();
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
        session()->flash('added_information');
        return redirect()->home();
    }

    public function delete(){
        $id = auth()->user()->id;
        User::deleteInformation($id);
        session()->flash('delete_information');
        return redirect()->home();
    }
}
