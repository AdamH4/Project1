<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Product;
use App\User;

class ProductsController extends Controller
{
    public function index(){
        $categories = Product::typeofProducts();
        $products = Product::paginate(10);
        return view('shop.products.products',compact('categories','products'));
    }

    public function show(Product $product){
        if (auth()->check()){
            $id = auth()->user()->id;
            $rated = Rating::rateOnce($id,$product->id);
            $user = new User();
        }
        $rating = $product->ratings()->avg('rating');
        $product->increment('visit');
        return view('shop.products.show-product', compact('product','rated','rating','user'));
    }

    public function filterByType($category){
        $categories = Product::typeofProducts();
        $products = Product::filterByType($category);
        return view('shop.products.products',compact('products','categories'));
    }

    public function filterByVisit(){
        $categories = Product::typeofProducts();
        $products = Product::filterByVisit();
        return view('shop.products.products',compact('products','categories'));
    }

    public function addComment(){
        $this->comments()->create([
            'body'=>request('body'),
            'user_id'=>auth()->user()->id
        ]);
    }

    public function priceUp(){
        $products = Product::priceUp();
        return view('shop.products.products',compact('products'));
    }

    public function priceDown(){
        $products = Product::priceDown();
        return view('shop.products.products',compact('products'));
    }
}
