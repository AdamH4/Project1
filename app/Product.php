<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','type','text','picture','price',
    ];


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
            ->get();
    }
}
