<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Rating;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index(){
        $types = Product::typeofProducts();
        $products = Product::paginate(10);
        return view('shop.products.products',compact('types','products'));
    }

    public function show(Product $product){
        $id = auth()->user()->id;
        $rating = $product->ratings()->avg('rating');
        $rated = Rating::rateOnce($id,$product->id);
        return view('shop.products.show-product', compact('product','rated','rating'));
    }

    public function filter($type){
        $products = Product::filterByType($type);
        return view('shop.products.type',compact('products'));
    }

    public function addComment()
    {
        $this->comments()->create([
            'body'=>request('body'),
            'user_id'=>auth()->user()->id
        ]);
    }
}
