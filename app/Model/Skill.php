<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;


    public function Advertises(){
        return $this->belongsToMany(
            Advertis::class,
            'advertis_skill',
            'skills_id',
            'advertis_id',
            'id',
            'id'
        );
    }


    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
