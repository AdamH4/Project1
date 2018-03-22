<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
use App\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Product $id,$rating){
        $id->addRating($rating);
        session()->flash('success_rate');
        return back();
    }

    public function delete(Product $product){
        $user = auth()->user()->id;
        try{
            $product->ratings()->where('user_id',$user)->delete();
            session()->flash('success_delete');
            return back();
        }catch(\Exception $e){
            return back()->withErrors('Error:'.$e->getMessage());
        }
    }
}
