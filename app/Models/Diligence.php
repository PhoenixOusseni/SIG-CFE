<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diligence extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }

    function personnel() {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }

    function marche() {
        return $this->belongsTo(Marche::class, 'marche_id');
    }

    public function criteres()
    {
        return $this->hasMany(Critere::class);
    }
}
