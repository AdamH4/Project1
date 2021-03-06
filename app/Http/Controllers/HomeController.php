<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function find(){
        $orderByPrice = request()->query('orderByPrice', false);
        $query = request()->get('search');
        $categories = Product::typeofProducts();
        if (isset($query)){
            $products = Product::search($query, $orderByPrice);
            if (! count($products) == 0) {
                return view('shop.products.products',compact('categories','products'));
            }
            return view('shop.products.no-products',compact('categories','query'));
        }
        return redirect()->back();
    }

    public function contacts(){
        $config['center']= 'Trstín';
        $config['zoom']= '13';
        $config['scrollwheel']= true;
        $marker['position']='48.521223, 17.469482';
        $gmap = app(GMaps::class);
        $gmap->initialize($config);
        $gmap->add_marker($marker);
        $map = $gmap->create_map();
        return view('shop.contacts.index',compact('map'));
    }

    public function information(){
        $comments = \DB::table('global_comments')->select('*')->paginate(10);
        return view('shop.about-us.index',compact('comments','date'));
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
                'author'=>'Anonym',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
        session()->flash('add_comment');
        return redirect()->back();
    }

}