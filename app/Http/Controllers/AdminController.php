<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\Transaction;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Gloudemans\Shoppingcart\Cart;

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
            'category'=>'required',
            'description'=>'required',
            'text'=>'required',
            'price'=>'required',
            'image'=>'required|image',
        ]);
        //take care of image
        $image = \request()->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $fileLocation = public_path('images/' . $filename);
        Image::make($image)->resize(400, 400)->save($fileLocation);
        $desc = request('description');
        //create row in table Product
        Product::create([
            'name'=>request('name'),
            'category'=>request('category'),
            'description'=>$desc,
            'text'=>request('text'),
            'picture'=>$filename,
            'price'=>request('price'),
        ]);
        //flash message
        session()->flash('success','You added new product');
        return redirect()->back();
    }

    public function deleteUser(User $user){
        try{
            $user->delete();
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors('error'.$e->getMessage());
        }
    }

    public function products(){
        $products = Product::paginate(12);
        return view('shop.admin.products', compact('products'));
    }

    public function deleteProduct(Product $product){
        try{
            $filename = $product->picture;
            $product->ratings()->delete();
            \File::delete(public_path('images/'.$filename));
            $product->delete();
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors('error'.$e->getMessage());
        }
    }

    public function show(Product $product){
        $rate = $product->ratings()->avg('rating');
        return view('shop.admin.show-product', compact('product','rate') );
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
        return back()->with('success_upgrade','User successfully promoted');
    }

    public function demote(User $user){
        \DB::table('admins')->where('id','=',$user->id)->delete();
        return back()->with('success_demote','Admin successfully demoted');
    }

    public function transactions(User $user){
        $transactions = $user->transactions($user->id)->groupBy('transactionid');
        return view('shop.admin.user-transactions',compact('transactions','user'));
    }

    public function completeTransaction($id){
        \DB::table('transactions')
            ->where('id', $id)
            ->update([
                'status'=> 1,
            ]);
        $users = User::all()->sort();
        return view('shop.admin.users',compact('users'))->with('transaction_success','Transaction was posted');
    }

    public function transactionOrder(User $user){
        $transactions = $user->transactions($user->id)->groupBy('transactionid')->sortBy('created_at');
        return view('shop.admin.user-transactions',compact('transactions','user'));
    }
}
