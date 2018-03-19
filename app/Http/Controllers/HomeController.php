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
        $comments = \DB::table('global_comments')->select('*')->get();
        return view('shop.about-us.index',compact('comments'));
    }

    public function globalComment(){
        $this->validate(request(),['body'=>'required']);
        if (auth()->check()){
            \DB::table('global_comments')->insert([
                'body'=>\request('body'),
                'author'=>auth()->user()->name,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }else{
            \DB::table('global_comments')->insert([
                'body'=>\request('body'),
                'author'=>'Anonyme',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
        return redirect()->back();
    }

}