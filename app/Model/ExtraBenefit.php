<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraBenefit extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    public function advertis(){
        return $this->belongsToMany(
            Advertis::class,
            'advertis_extra_benefit',
            'extra_benefits_id',
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
