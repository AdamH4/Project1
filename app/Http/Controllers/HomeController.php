<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(){


    }


    public function index()
    {

        return view('master');
    }


    public function find(Request $request)
    {
        $query = $request->get('search');


        if (isset($query)) {

            $tasks = Product::where('name', 'LIKE', '%' . $query . '%')
                ->orderByRaw('name asc')
                ->get();


            if (count($tasks) > 0) {

                return view('shop.index')
                    ->withDetails($tasks)
                    ->withQuery($query);

            } else {
                return view('shop.index')
                    ->withMessage('No results try again!');
            }

        }
        return view('master');
    }
}