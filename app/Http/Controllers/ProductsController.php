<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index(){
        $types = Product::typeofProducts();
        $products = Product::all();
        return view('shop.products.products',compact('types','products'));
    }


    public function show(Product $product){

        return view('shop.products.show-product', compact('product') );
    }

    public function filter($type){


        $products = Product::filterByType($type);


        return view('shop.products.type',compact('products'));

    }

}
