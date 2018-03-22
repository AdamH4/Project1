<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Product $id){
        $this->validate(request(),['body'=>'required']);
        $id->addComment();
        session()->flash('add_comment');
        return back();
    }

    public function delete(Comment $id){
        try{
            $id->delete();
            session()->flash('delete_comment');
            return back();
        }catch(\Exception $e){
            return back()->withErrors('Error:'.$e->getMessage());
        }
    }

}
