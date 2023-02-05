<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityAdvertis extends Model
{
    use HasFactory;


    public function advertis(){
        return $this->hasMany(Advertis::class, 'city_advertis_id', 'id');
    }

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
    public function StateAdvertis(){
        return $this->belongsTo(StateAdvertis::class, 'state_advertis_id', 'id')->withDefault();
    }


    public function Governorates(){
        return $this->hasMany(Governorate::class, 'city_advertis_id', 'id');
    }
}
