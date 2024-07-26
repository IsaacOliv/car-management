<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acessibilidade extends Model
{
    use HasFactory;
    protected $table = 'acessibilidades';
    protected $fillable = [
        'categoria',
    ];


    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'id_acessibilidade', 'id');
    }
}
