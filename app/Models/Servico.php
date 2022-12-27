<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Servico extends Model
{
    use HasFactory;
    protected $fillable = [ 'ser_name', 'ser_price', 'ser_sessions', 'area_id', 'ser_availability', 'ser_image', 'ser_time' ];

    public function profissionais(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Profissional::class)->withTimestamps();
    }

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
