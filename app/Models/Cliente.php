<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 * @method static where(string $string, string $string1, $id)
 * @method static create(array $array)
 */
class Cliente extends Model
{

    use HasFactory;
    protected $fillable = ['clie_name', 'clie_email', 'clie_phone', 'clie_bornday', 'clie_cpf',
        'clie_address_street', 'clie_address_district', 'clie_address_complement', 'clie_address_number',
        'clie_address_zipcode', 'city_id', 'user_id' ];

    public function city()
    {
        return $this->hasOne(City::class);
    }

    public function ordemDeServicos()
    {
        return $this->hasMany(OrdemDeServico::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
