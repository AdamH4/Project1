<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Product[]
     */
    public function products() {
        $this->hasMany(\DB::table('transaction_products'));
    }
}
