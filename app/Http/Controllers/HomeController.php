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
        $categories = Product::typeofProducts();
        if (isset($query)) {
            $products = Product::search($query);
            if (! count($products) == 0) {
                return view('shop.products.products',compact('categories','products'));
            }
            return view('shop.products.no-products',compact('categories','query'));
        }
        return redirect()->back();
    }

    public function contacts(){
        return view('shop.contacts.index');
    }

    public function information(){
        return view('shop.information.index');
    }
}