<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Product[]
     */
    public function products() {
        return $this->belongsToMany(Product::class);
        //return DB::table('transaction_products')->where('transaction_id', $this->id);
    }
}
