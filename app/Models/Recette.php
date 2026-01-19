<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function User() {
        return $this->belongsTo(User::class, 'users_id');
    }

    function ElementRecette() {
        return $this->hasMany(ElementRecette::class, 'recettes_id', 'id');
    }

    function Budget() {
        return $this->belongsTo(Budget::class, 'budgets_id');
    }

    function Contribuable() {
        return $this->belongsTo(Contribuable::class, 'contribuables_id');
    }

    public function Reglement()
    {
        return $this->hasMany(ReglementFacture::class);
    }

    function Signataire() {
        return $this->belongsTo(Signataire::class, 'signataires_id');
    }
}
