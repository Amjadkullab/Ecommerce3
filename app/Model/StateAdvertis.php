<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateAdvertis extends Model
{
    use HasFactory;


    public function advertis(){
        return $this->hasMany(Advertis::class, 'state_advertis_id', 'id');
    }

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
    public function CityAdvertis(){
        return $this->hasMany(CityAdvertis::class, 'state_advertis_id', 'id');
    }
}
