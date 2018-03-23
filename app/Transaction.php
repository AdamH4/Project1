<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    protected $fillable = [
        'id', 'user_id', 'payment_type', 'total','note'
    ];

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

    public function addProduct($products, $userId, $total, $payment,$type,$note,$info){
        $id = DB::table('transactions')->insertGetId([
            'user_id'=>$userId,
            'total'=>$total,
            'payment_type'=>$payment,
            'status'=>0,
            'delivery_type'=>$type,
            'note'=>$note,
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

        \DB::table('transaction_information')->insert([
            'transaction_id'=>$id,
            'first_name'=>$info['first_name'],
            'last_name'=>$info['last_name'],
            'city'=>$info['city'],
            'street'=>$info['street'],
            'postcode'=>$info['postcode'],
            'country'=>$info['country'],
            'phone_number'=>$info['phone_number'],
        ]);
    }
}
