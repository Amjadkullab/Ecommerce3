<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public function Advertis(){
        return $this->belongsToMany(
            Advertis::class,
            'advertis_language',
            'language_id',
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
