<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $orderByPrice = request()->query('orderByPrice', false);
        $categories = Product::typeofProducts();
        $products = Product::selectAll($orderByPrice);
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

    public function filter(string $category, Request $request){
        $orderByPrice = $request->query('orderByPrice', false);
        $categories = Product::typeofProducts();
        $products = Product::filter($category, $orderByPrice);
        return view('shop.products.products', compact('products','categories'));
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

}
