<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    public function advertis(){
        return $this->hasMany(Advertis::class, 'experience_id', 'id');
    }


    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
