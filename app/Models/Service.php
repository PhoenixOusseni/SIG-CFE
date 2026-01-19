<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function personnel()
    {
        return $this->hasMany(Personnel::class);
    }

    public function diligences()
    {
        return $this->hasMany(Diligence::class);
    }

    public function traitements()
    {
        return $this->hasMany(Traitement::class);
    }

    public function criteres()
    {
        return $this->hasMany(Critere::class);
    }
}
