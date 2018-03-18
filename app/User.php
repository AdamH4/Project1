<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return !is_null(DB::table('admins')->find($this->id));
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));//treba upravit design
    }

    public static function verified($id){
        return static::selectRaw('id, name, token')
            ->where([
                ['id','=',$id],
                ['token','=',null]
            ])
            ->get();
    }

    public function transactions($id){
        return \DB::table('transactions')
            ->selectRaw('products.picture as picture, products.name as name, transaction_products.quantity as quantity, products.category as category, transactions.id as transactionid, transactions.status as status, transactions.payment_type as payment_type, transactions.delivery_type as delivery_type,transactions.note as note')
            ->where('user_id','=',$id)
            ->join('transaction_products','transactions.id','=','transaction_products.transaction_id')
            ->join('products','transaction_products.product_id','=','products.id')
            ->get();
    }

    public function completedTransaction($id){
        return \DB::table('transactions')
            ->select('*')
            ->where('user_id',$id)
            ->where('status','=','0')
            ->get();
    }

    public static function addInformation($id){
        return static::where('id',$id)
            ->update([
                'first_name'=>request('first_name'),
                'last_name'=>request('last_name'),
                'city'=>request('city'),
                'street'=>request('street'),
                'postcode'=>request('postcode'),
                'country'=>request('country'),
                'phone_number'=>request('phone_number'),
            ]);
    }

    public static function hasInformation($id){
        return static::where('id',$id)
            ->where([
                ['last_name','!=', null],
                ['first_name','!=', null],
                ['city','!=', null],
                ['street','!=', null],
                ['country','!=', null],
                ['postcode','!=', null],
                ['phone_number','!=', null],
            ])
            ->get();
    }

    public static function deleteInformation($id){
        return static::where('id',$id)
            ->update([
                'first_name'=>null,
                'last_name'=>null,
                'city'=>null,
                'street'=>null,
                'postcode'=>null,
                'country'=>null,
                'phone_number'=>null,
            ]);
    }
}