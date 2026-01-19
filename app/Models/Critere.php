<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }

    function diligence() {
        return $this->belongsTo(Diligence::class, 'diligence_id');
    }

    public function traitements()
    {
        return $this->hasMany(Traitement::class);
    }
}
