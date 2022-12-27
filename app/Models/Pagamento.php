<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pagamento extends Model
{
    protected $fillable = ['ord_id', 'pag_price', 'pag_indicator', 'mei_id', 'pag_open', 'con_id', 'clie_id', 'pro_id', 'cli_id', 'pag_type'];
    use HasFactory;

    public function ordemDeServico()
    {
        return $this->hasOne(OrdemDeServico::class);
    }

    public function contaBancaria()
    {
        return $this->hasOne(ContaBancaria::class);
    }

    public function meiosPagamento()
    {
        return $this->hasMany(MeioPagamento::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
}
