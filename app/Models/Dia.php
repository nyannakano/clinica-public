<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;

    public function horas()
    {
        return $this->belongsToMany(Hora::class);
    }

    public function exceptions()
    {
        return $this->belongsToMany(Exception::class);
    }
}
