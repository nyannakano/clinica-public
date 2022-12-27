<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = "profissionais";

    protected $fillable = [ 'pro_name', 'pro_health_plan', 'area_id', 'pro_color', 'pro_del'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class)->withTimestamps();
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }

    public function horas()
    {
        return $this->hasMany(Hora::class);
    }

}
