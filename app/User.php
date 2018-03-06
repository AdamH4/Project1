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

    public function transactions($id){
        return \DB::table('transactions')
            ->where('transactions.id','=',$id)
            ->join('transaction_products','transactions.id','=','transaction_products.transaction_id')
            ->join('products','transaction_products.product_id','=','products.id')
            ->selectRaw('transaction_products.product_id, transaction_products.quantity , transactions.user_id, products.name, products.picture, products.price, products.category')
            ->get();
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

}