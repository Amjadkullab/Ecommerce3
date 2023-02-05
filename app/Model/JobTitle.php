<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    public function Advertis(){
        return $this->hasMany(Advertis::class, 'job_title_id', 'id');
    }


    public function CareerSector(){
        return $this->belongsTo(CareerSector::class, 'career_sector_id', 'id')->withDefault([
            'name' => 'لا يوجد',
        ]);

    }

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
