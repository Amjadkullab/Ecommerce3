<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;


    public function Advertis(){
        return $this->hasMany(Advertis::class, 'governorates_id', 'id');
    }

    public function CityAdvertis(){
        return $this->belongsTo(CityAdvertis::class, 'city_advertis_id', 'id')->withDefault();
    }


    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }






}
