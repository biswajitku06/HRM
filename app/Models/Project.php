<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table='projects';
    protected $fillable=['name', 'required_zira'];

    public function dailyupdate()
    {
        return $this->hasMany(DailyUpdate::class);
    }
}
