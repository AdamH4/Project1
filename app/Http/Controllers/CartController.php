<?php

namespace App\Http\Controllers;

use App\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Request;

class CartController extends Controller
{
    public function store($id){
        $userId= auth()->user()->id;
        $p = Product::find($id);
        $cart = app(Cart::class);
        $cart->instance($userId)->add([
            'id'=>$p->id,
            'name'=>$p->name,
            'qty'=>$p->quantity,
            'price'=>$p->price,
        ]);
        return back();
    }

    public function index(){
        $userId = auth()->user()->id;
        $cart = app(Cart::class);
        $products = $cart->instance($userId)->content();
        $total = $cart->instance($userId)->subtotal();
        return view('shop.cart.index',compact('products','total'));
    }

    public function deleteAll(){
        $userId = auth()->user()->id;
        $cart = app(Cart::class);
        $cart->instance($userId)->destroy();
        return redirect()->back();
    }

    public function deleteOne($id){
        $userId = auth()->user()->id;
        $cart = app(Cart::class);
        $cart->instance($userId)->remove($id);
        return redirect()->back();
    }

    public function plus($id){
        $userId = auth()->user()->id;
        $cart = app(Cart::class);
        $item = $cart->instance($userId)->get($id);
        $cart->instance($userId)->update($id,$item->qty + 1);
        return redirect()->back();
    }

    public function minus($id){
        $userId = auth()->user()->id;
        $cart = app(Cart::class);
        $item = $cart->instance($userId)->get($id);
        $cart->instance($userId)->update($id,$item->qty - 1);
        return redirect()->back();
    }

    public function card($total){

        return view('shop.cart.card',compact('total'));
    }

    public function checkout(){

        $this->validate(request(),[
           'address'=>'required',
           'postcode'=>'required',
        ]);

        $r = request()->all();
        $cart = app(Cart::class);
        $total = $cart->subtotal();
        try {
            Stripe::charges()->create([
                'amount' => $total,
                'currency' => 'EUR',
                'source' => $r['stripeToken'],
                'description' => 'Description goes here',
                'receipt_email' => 'adam.harnusek@gmail.com',
                'metadata' => [
                    'data1' => 'metadata 1',
                    'data2' => 'metadata 2',
                    'data3' => 'metadata 3',
                ],
            ]);
            return back()->with('success_message', 'Thanks for your money!');
        }catch(CardErrorException $e){
            return back()->withErrors('Error!'.$e->getMessage());
        }
    }






}
