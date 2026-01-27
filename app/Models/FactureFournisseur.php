<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureFournisseur extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function User() {
        return $this->belongsTo(User::class, 'users_id');
    }

    function BaseTaxable() {
        return $this->belongsTo(BaseTaxable::class, 'base_taxable_id');
    }

    function Fournisseur() {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }

    function ElementFacture() {
        return $this->hasMany(ElementFacture::class, 'facture_fournisseurs_id', 'id');
    }

    public function ReglementFournisseur()
    {
        return $this->hasMany(ReglementFournisseur::class);
    }

    function Signataire() {
        return $this->belongsTo(Signataire::class, 'signataires_id');
    }
}
