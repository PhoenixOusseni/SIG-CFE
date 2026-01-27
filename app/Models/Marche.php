<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marche extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function contribuable()
    {
        return $this->belongsTo(Contribuable::class, 'contribuable_id');
    }

    public function details()
    {
        return $this->hasMany(MarcheDetail::class, 'marche_id');
    }

    public function personnels()
    {
        return $this->hasManyThrough(Personnel::class, MarcheDetail::class, 'marche_id', 'id', 'id', 'personnel_id');
    }

    public function baseTaxable()
    {
        return $this->belongsTo(BaseTaxable::class, 'base_taxables_id');
    }

    public function diligences()
    {
        return $this->hasMany(Diligence::class, 'marche_id');
    }
}
