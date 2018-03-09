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
            ->selectRaw('products.picture as picture, products.name as name, transaction_products.quantity as quantity, products.category as category, transactions.id as transactionid, transactions.status as status, transactions.payment_type as payment_type')
            ->where('user_id','=',$id)
            ->join('transaction_products','transactions.id','=','transaction_products.transaction_id')
            ->join('products','transaction_products.product_id','=','products.id')
            ->get();
    }


}