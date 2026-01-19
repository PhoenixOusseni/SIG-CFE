<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
