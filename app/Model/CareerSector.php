<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSector extends Model
{
    use HasFactory;

    public function Advertis(){
        return $this->hasMany(Advertis::class, 'career_sector_id', 'id');
    }


    public function jobtitles(){
        return $this->hasMany(JobTitle::class, 'career_sector_id', 'id');
    }


    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
