<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rating','user_id','product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function rateOnce($user_id,$product_id){
        return static::selectRaw('id, user_id, product_id, rating')
            ->where([
                ['user_id','=',$user_id],
                ['product_id','=',$product_id],
            ])
            ->get();
    }
}
