<?php

namespace App\Http\Controllers;

use App\Mail\CardOrder;
use App\Mail\Order;
use App\Product;
use App\User;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Cart;

class CartController extends Controller
{
    public function index(){
        if (auth()->check()){
            $userId = auth()->user()->id;
            $user = new User();
            $u = $user->verified($userId);
            $cart = app(Cart::class);
            $products = $cart->instance($userId)->content();
            $total = $cart->instance($userId)->subtotal();
        }
        return view('shop.cart.index',compact('products','total','u'));
    }

    public function store($id){
        $quantity = request('quantity');
        $userId= auth()->user()->id;
        $p = Product::find($id);
        $cart = app(Cart::class);
        $cart->instance($userId)->add([
            'id'=>$p->id,
            'name'=>$p->name,
            'qty'=>$quantity,
            'price'=>$p->price,
            'options'=>[
               'picture'=>$p->picture,
            ],
        ]);
        return back();
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
        $userId = auth()->user()->id;
        $user = auth()->user();
        $cart = app(Cart::class);
        $total = $cart->instance($userId)->subtotal();
        $r = request()->all();
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
            \Mail::to($user)->send(new CardOrder($cart));
            $cart->instance($userId)->destroy();
            return view('shop.cart.success', compact('total'));
            } catch(\CardErrorException $e){
                return view('shop.cart.unsuccess')->with('error','Something went wrong try again');
            }
    }

    public function selectPayment($total){
        return view('shop.cart.select-payment',compact('total'));
    }

    public function cashOnDelivery($total){
        return view('shop.cart.cashOnDelivery',compact('total'));
    }

    public function cashOnDeliveryCheckout($total){
        $this->validate(request(),[
           'first_name'=>'required',
           'second_name'=>'required',
           'city'=>'required',
           'street'=>'required',
           'address'=>'required',
           'second_address'=>'required',
           'postcode'=>'required|numeric',
           'phone'=>'required|numeric',
        ]);
        $userId = auth()->user()->id;
        $cart = app(Cart::class);
        \Mail::to(auth()->user())->send(new Order($cart));
        $cart->instance($userId)->destroy();
        return view('shop.cart.success',compact('total'));
    }
}
