<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeioPagamento extends Model
{
    use HasFactory;

    protected $table = 'meios_pagamento';
    protected $fillable = [ 'mei_name', 'mei_indicator' ];

    public function pagamentos()
    {
        return $this->belongsToMany(Pagamento::class);
    }
}
