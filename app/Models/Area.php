<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, string $string2)
 */
class Area extends Model
{
    use HasFactory;

    protected $fillable = [ 'area_name' ];

    public function profissionais()
    {
        return $this->hasMany(Profissional::class);
    }
}
