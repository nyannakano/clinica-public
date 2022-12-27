<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    use HasFactory;

    protected $fillable = [ 'horas_start', 'horas_interval', 'horas_return', 'horas_end', 'profissional_id', 'dia_id' ];

    public function dia()
    {
        return $this->hasOne(Dia::class);
    }

    public function profissional()
    {
        return $this->hasOne(Profissional::class);
    }
}
