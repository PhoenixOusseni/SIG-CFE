<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourcePrelevement extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function ElementRecette()
    {
        return $this->hasMany(ElementRecette::class);
    }
}
