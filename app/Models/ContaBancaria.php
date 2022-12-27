<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaBancaria extends Model
{
    use HasFactory;
    protected $table = 'contas_bancarias';
    protected $fillable = [ 'con_name', 'con_bank', 'con_balance' ];

    public function pagamentos()
    {
        return $this->belongsToMany(Pagamento::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}
