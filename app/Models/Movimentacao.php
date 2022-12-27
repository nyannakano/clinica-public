<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = "movimentacoes";

    protected $fillable = [ 'mov_description', 'mov_type', 'mov_value', 'clie_id', 'pro_id', 'par_id', 'mov_cancel', 'con_id', 'mov_date' ];

    public function cliente()
    {
        $this->hasOne(Cliente::class);
    }

    public function profissional()
    {
        $this->hasOne(Profissional::class);
    }

    public function parcela()
    {
        $this->hasOne(Parcela::class);
    }

    public function contaBancaria()
    {
        $this->hasOne(ContaBancaria::class);
    }
}
