<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function Recette()
    {
        return $this->hasMany(Recette::class, 'budgets_id', 'id');
    }

    public function FactureFournisseur()
    {
        return $this->hasMany(FactureFournisseur::class, 'budgets_id', 'id');
    }
}
