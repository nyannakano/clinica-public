<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeServico extends Model
{
    use HasFactory;

    protected $table = 'ordem_de_servicos';
    protected $fillable = [
        'cli_id',
        'ser_id',
        'pro_id',
        'ord_sessions',
        'ord_description',
        'ord_additional',
        'clie_id'
    ];

    public function profissional()
    {
        return $this->hasOne(Profissional::class);
    }

    public function servico()
    {
        return $this->hasOne(Servico::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function agendamentos()
    {
        return $this->belongsToMany(Agendamento::class);
    }

    public function pagamentos()
    {
        return $this->belongsTo(Pagamentos::class);
    }
}
