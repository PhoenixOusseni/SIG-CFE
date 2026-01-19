<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementRecette extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function Recette()
    {
        return $this->hasMany(Recette::class);
    }

    function Base() {
        return $this->belongsTo(BaseTaxable::class, 'base_taxables_id');
    }

    function Source() {
        return $this->belongsTo(SourcePrelevement::class, 'source_prelevements_id');
    }
}
