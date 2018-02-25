<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{

    public function __construct(){
        //make middleware
        $this->middleware('admin');
    }

    public function index(){
        //select all users
        $users = User::all()->sort();
        return view('shop.admin.users',compact('users'));
    }

    public function createProduct(){
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
        $fileLocation = public_path('images/' . $filename);
        Image::make($image)->resize(400, 400)->save($fileLocation);


        //create row in table Product
        Product::create([
            'name'=>request('name'),
            'type'=>request('type'),
            'text'=>request('text'),
            'picture'=>$filename,
            'price'=>request('price'),
        ]);

        //make here some flash message
        session()->flash('success','You added new product');

        return redirect()->back();

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
        $products = Product::paginate(10);
        return view('shop.admin.products', compact('products'));
    }

    public function deleteProduct(Product $product){
        try{$product->delete();
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors('error'.$e->getMessage());
        }
    }

    public function show(Product $product){
        return view('shop.admin.show-product', compact('product') );
    }

    public function delete(Comment $id){
        try{
            $id->delete();
            return back()->with('success_delete','Delete was successful');
        }catch (\Exception $e){
            return back()->withErrors('Error:'.$e->getMessage());
        }
    }

    public function promote(User $user){
        \DB::table('admins')->insert(['id'=>$user->id]);
        return back()->with('success_upgrade','User succesfully promoted');
    }

    public function demote(User $user){
        \DB::table('admins')->where('id','=',$user->id)->delete();
        return back()->with('success_demote','Admin successfully demoted');
    }
}
