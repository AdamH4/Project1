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
            'user_id'=>auth()->user()->id,
        ]);
    }

    public function transactedProducts(){
        return $this->hasMany(TransactionProducts::class);
    }

    public function addRating($rating){
        return $this->ratings()->create([
            'rating'=>$rating,
            'user_id'=>auth()->user()->id,
        ]);
    }

    public static function typeofProducts(){
        return static::selectRaw('category , count(*) howmany')
            ->orderByRaw('category asc')
            ->groupBy('category')
            ->get();

    }

    public static function selectAll($orderByPrice = false){
        $query = static::select('*');
        if ($orderByPrice){
            $query->orderBy('price',$orderByPrice == 'asc' ? 'ASC' : 'DESC');
        }
        return $query->paginate(12);
    }

    public static function filter($category, $orderByPrice = false){
        $query = static::select(['id', 'name', 'category', 'picture', 'price'])
            ->where('category','LIKE', $category);

        if ($orderByPrice) {
            $query->orderBy('price', $orderByPrice == 'asc' ? 'ASC' : 'DESC');
        }

        return $query->paginate(12);
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
            ->paginate(12);
    }

    public static function priceUp(){
        return static::selectRaw('id, name, category, description, text, picture, price, visit, quantity')
            ->orderByRaw('price asc')
            ->paginate(12);
    }

    public static function priceDown(){
        return static::selectRaw('id, name, category, description, text, picture, price, visit, quantity')
            ->orderByRaw('price desc')
            ->paginate(12);
    }
}
