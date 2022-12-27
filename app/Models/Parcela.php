<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    protected $fillable = [ 'par_price', 'par_number', 'pag_id', 'pag_status', 'par_deadline', 'par_type' ];

    public function pagamento(){
        $this->hasOne(Pagamento::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }


}
