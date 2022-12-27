<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [ 'title', 'start', 'end', 'color', 'description', 'ord_id', 'status', 'pro_id', 'clie_id', 'ser_id', 'price', 'auth' ];

    public function ordemDeServico()
    {
        return $this->hasOne(OrdemDeServico::class);
    }

    public function profissional()
    {
        return $this->hasOne(Profissional::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function getStartAttribute($value)
    {
        $datestart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
        $timestart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

        return $this->start = ($timestart == "00:00:00" ? $datestart : $value);
    }
    public function getEndAttribute($value)
    {
        $dateend = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
        $timeend = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

        return $this->end = ($timeend == "00:00:00" ? $dateend : $value);
    }
}
