<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;
    protected $table = 'veiculos';
    protected $fillable = [
        'modelo',
        'placa',
        'dataAquisicao',
        'id_acessibilidade',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'dataAquisicao',
    ];


    public function acessibilidade()
    {
        return $this->belongsTo(Acessibilidade::class, 'id_acessibilidade', 'id');
    }

}
