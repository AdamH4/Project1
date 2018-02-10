<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function typeofProducts(){

        return static::selectRaw('type, count(*) howmany')
            ->groupBy('type')
            ->orderByRaw('(type)asc')
            ->get();
    }

    public static function filterByType(){

        return static::selectRaw('name, type')
            ->groupBy('type')
            ->orderByRaw('name asc')
            ->get();
    }
}
