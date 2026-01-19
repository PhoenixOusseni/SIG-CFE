<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementFacture extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function FactureFournisseure()
    {
        return $this->hasMany(FactureFournisseur::class);
    }
}
