<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseTaxable extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function Famille() {
        return $this->belongsTo(Famille::class, 'familles_id');
    }

    function marche() {
        return $this->hasMany(Marche::class, 'base_taxables_id');
    }
}
