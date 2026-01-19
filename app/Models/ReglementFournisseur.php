<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementFournisseur extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function FactureFournisseur() {
        return $this->belongsTo(FactureFournisseur::class, 'facture_fournisseurs_id');
    }
}
