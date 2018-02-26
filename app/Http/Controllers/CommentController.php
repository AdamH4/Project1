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
        return back();
    }

    public function delete(Comment $id){
        try{
            $id->delete();
            return back()->with('success_delete','Your comment was deleted');
        }catch(\Exception $e){
            return back()->withErrors('Error:'.$e->getMessage());
        }
    }

}
