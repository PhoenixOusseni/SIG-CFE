<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'fonction',
        'photo'
    ];

    function Recette() {
        return $this->hasOne(Recette::class);
    }

    function FactureFournisseur() {
        return $this->hasOne(FactureFournisseur::class);
    }

    // public function getPhotoAttribute($value)
    // {
    //     return asset('storage/' . $value);
    // }

    // public function setPhotoAttribute($value)
    // {
    //     $this->attributes['photo'] = $value->store('images', 'public');
    // }
}
