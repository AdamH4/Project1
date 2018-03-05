<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserResetPasswordNotification;
use App\Notifications\Verify;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];

    public function isAdmin()
    {
        return !is_null(DB::table('admins')->find($this->id));
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function orders(){
        return $this->hasManyThrough(\DB::table('transaction_products'), \DB::table('transactions'));
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
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