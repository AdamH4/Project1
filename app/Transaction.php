<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    protected $fillable = [
        'id', 'user_id', 'payment_type', 'total',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Product[]
     */
    public function products() {
        $this->hasMany(TransactionProducts::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }

    public function transactions(){
        return $this->hasManyThrough(Product::class,TransactionProducts::class);
    }

    public static function where($id){
        return static::select('*')
            ->where('user_id','=',$id)
            ->get();
    }

    public function addProduct($products, $userId, $total, $payment,$type){
        $id = DB::table('transactions')->insertGetId([
            'user_id'=>$userId,
            'total'=>$total,
            'payment_type'=>$payment,
            'status'=>0,
            'delivery_type'=>$type,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        foreach ($products as $product){
            DB::table('transaction_products')->insert([
                'transaction_id' => $id,
                'product_id' => $product->id,
                'quantity' => $product->qty,
            ]);
        }
    }
}
