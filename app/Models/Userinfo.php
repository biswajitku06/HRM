<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $table='user_infos';
    protected $fillable=['user_id', 'country', 'street1', 'street2', 'city', 'state', 'zip', 'sex'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
