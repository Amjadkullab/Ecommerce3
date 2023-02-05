<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiseType extends Model
{
    use HasFactory;

    public function advertis(){
        return $this->hasMany(Advertis::class, 'advertise_type_id', 'id');
    }


    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
