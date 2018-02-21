<?php

namespace App\Http\Controllers;

use App\Product;
use Anam\Phpcart\Cart;

class CartController extends Controller
{

    public function index(){

        $cart = new Cart;
        $products = $cart->items();
        $total = $cart->getTotal();
        return view('shop.cart.index', compact('products','total'));

    }


    public function store($id){
        $cart = new Cart;
        $product = Product::find($id);
        $item = [
            'id'=>$product->id,
            'name'=>$product->name,
            'quantity'=>$product->quantity,
            'price'=>$product->price,
            'text'=>$product->text,
            'picture'=>$product->picture,
            'type'=>$product->type,
        ];
        $cart->add($item);

        session()->flash('success','Item was sent to the cart');
        return redirect()->back();

    }

    public function deleteOne($id){
        $cart = new Cart;
        $cart->remove($id);
        return redirect()->back();
    }

    public function deleteAll(){
        $cart = new Cart;
        $cart->clear();
        session()->flash('empty','Cart is empty');
        return redirect()->back();
    }

    public function plus($id){
        $cart = new Cart;
        $product = $cart->get($id);
        $cart->updateQty($id,$product->quantity + 1);
        return redirect()->back();
    }

    public function minus($id){
        $cart = new Cart;
        $product = $cart->get($id);
        if ($product->quantity == 1){
            //putt message here
            return redirect()->back();
        }
        $cart->updateQty($id,$product->quantity - 1);
        return redirect()->back();
    }

    public function card(){
        $cart = new Cart;
        $total = $cart->getTotal();
        return view('shop.cart.card', compact('total'));
    }

    public function checkout(){


        return view('shop.cart.pay');
    }






}
