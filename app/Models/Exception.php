<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{

    use HasFactory;

    protected $fillable = [ 'exc_horas_start', 'exc_horas_end', 'exc_dia', 'profissional_id' ];

    public function profissional()
    {
        return $this->hasOne(Profissional::class);
    }

}
