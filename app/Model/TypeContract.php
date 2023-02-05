<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContract extends Model
{
    use HasFactory;

    protected $table = 'type_contracts';

    public function advertis(){
        return $this->hasMany(Advertis::class, 'type_contract_id', 'id');
    }

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
