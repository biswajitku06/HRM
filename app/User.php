<?php

namespace App;

use App\Models\Userinfo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'designation', 'image',
        'email','mobile', 'password','status','activestatus','role','reset_code','points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userinfo()
    {
        return $this->hasOne(Userinfo::class);
    }

    public function dailyUpdate()
    {
        $this->hasMany('App\Models\DailyUpdate','user_id');
    }
}
