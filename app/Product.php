<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','type','text','picture','price','description','visit',
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function addComment(){
        return $this->comments()->create([
            'body'=>request('body'),
            'user_id'=>auth()->user()->id
        ]);
    }

    public function addRating(){
        return $this->ratings()->create([
            'rating'=>request('rating'),
            'user_id'=>auth()->user()->id,
        ]);
    }

    public static function typeofProducts(){

        return static::selectRaw('type, count(*) howmany')
            ->groupBy('type')
            ->orderByRaw('(type)asc')
            ->get();
    }

    public static function filterByType($type){

        return static::selectRaw('id, name, type, picture')
            ->where('type','LIKE', $type)
            ->orderByRaw('name asc')
            ->paginate(10);
    }
}
