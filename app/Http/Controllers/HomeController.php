<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if (auth()->check()){
            $id = auth()->user()->id;
            $user = new User();
            $u = $user->verified($id);
        }
        return view('shop.index',compact('u'));
    }

    public function find(Request $request){
        $query = $request->get('search');
        if (isset($query)) {
            $tasks = Product::search($query);
            if (! count($tasks) == 0) {
                return view('shop.index')
                    ->withDetails($tasks)
                    ->withQuery($query);
            }
        }
        return view('shop.index',[
            'unsuccess_message' => 'No results!',
        ]);
    }

    public function contacts(){
        return view('shop.contacts.index');
    }
}