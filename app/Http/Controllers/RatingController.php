<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
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

    public function delete(){
        /*$user = auth()->user()->id;
        $rating = Rating::rateOnce($user);
        try{
            $rating->delete();
            return back()->with('sucess_delete','You successfully deleted your rating');
        }catch(\Exception $e){
            return back()->withErrors('Error:'.$e->getMessage());
        }*/
    }
}
