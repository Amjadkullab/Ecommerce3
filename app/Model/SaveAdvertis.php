<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveAdvertis extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertis_id', 'users_id',
    ];


    public function wishlistAdvertis()
    {
        return $this->belongsTo(Advertis::class, 'advertis_id');
    }

    public function Advertis_full_info()
    {
        return $this->belongsTo(Advertis::class, 'advertis_id');
    }
}
