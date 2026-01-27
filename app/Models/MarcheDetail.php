<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcheDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'marche_id',
        'personnel_id',
        'temps',
    ];

    public function marche()
    {
        return $this->belongsTo(Marche::class, 'marche_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}
