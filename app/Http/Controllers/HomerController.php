<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomerController extends Controller
{
    public function index()
    {

        return view('master');
    }


    public function find()
    {
        $query = Input::get('search');
        dd($query);

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