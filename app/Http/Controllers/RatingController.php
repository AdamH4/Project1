<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
use App\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Product $id){
        $this->validate(request(),[
           'rating'=>'required'
        ]);
        $id->addRating();
        return back();
    }

    public function delete(Product $product){
        $user = auth()->user()->id;
        try{
            $product->ratings()->where('user_id',$user)->delete();
            return back()->with('success_delete','You successfully deleted your rating');
        }catch(\Exception $e){
            return back()->withErrors('Error:'.$e->getMessage());
        }
    }
}
