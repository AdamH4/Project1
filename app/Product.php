<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','category','text','picture','price','description','visit',
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

    public function transactedProducts(){
        return $this->hasMany(TransactionProducts::class);
    }

    public function addRating(){
        return $this->ratings()->create([
            'rating'=>request()->rating,
            'user_id'=>auth()->user()->id,
        ]);
    }

    public static function typeofProducts(){
        return static::selectRaw('category , count(*) howmany')
            ->orderByRaw('category asc')
            ->groupBy('category')
            ->get();

    }

    public static function filterByType($category){
        return static::select(['id', 'name', 'category', 'picture', 'price'])
            ->where('category','LIKE', $category)
            ->orderBy('name')
            ->paginate(12);
    }

    public static function filterByVisit(){
        return static::selectRaw('id, name, category, description, text, picture, price, visit, quantity')
            ->orderByRaw('visit desc')
            ->paginate(12);
    }

    public static function search($query){
        return static::selectRaw('id, name, category, description, text, picture, price, visit, quantity')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('category','LIKE','%'.$query.'%')
            ->orderByRaw('name asc')
            ->get();
    }

    public static function priceUp(){
        return static::selectRaw('id, name, category, description, text, picture, price, visit, quantity')
            ->orderByRaw('price asc')
            ->paginate(10);
    }

    public static function priceDown(){
        return static::selectRaw('id, name, category, description, text, picture, price, visit, quantity')
            ->orderByRaw('price desc')
            ->paginate(10);
    }
}
