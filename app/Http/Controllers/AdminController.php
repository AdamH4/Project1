<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{

    public function __construct(){
        //make middleware
        $this->middleware('admin');
    }
    public function show(){
        return view('shop.admin.admin');
    }


    public function index(){
        //select all users
        $users = User::all();
        return view('shop.admin.users',compact('users'));
    }


    public function create(){

        return view('shop.admin.create');
    }

    public function store(){
        // validate request()

        $this->validate(request(),[
            'name'=>'required',
            'type'=>'required',
            'text'=>'required',
            'price'=>'required',
            'image'=>'required|image',
        ]);

        //take care of image
        $image = \request()->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $fileLocation = public_path('images/'. $filename);
        Image::make($image)->resize(400,400)->save($fileLocation);


        //create row in table Product
        Product::create([
            'name'=>request('name'),
            'type'=>request('type'),
            'text'=>request('text'),
            'picture'=>$filename,
            'price'=>request('price'),
        ]);

        //make here some flash message

        return redirect('/admin/create');

    }

    public function deleteUser(User $user)
    {
        //delete user here using wild card
        try{$user->delete();
        return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors('error'.$e->getMessage());
        }

    }

    public function products(){
        $products = Product::all();
        return view('shop.admin.products', compact('products'));
    }

    public function deleteProduct(Product $product){
        try{$product->delete();
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors('error'.$e->getMessage());
        }
    }
}
