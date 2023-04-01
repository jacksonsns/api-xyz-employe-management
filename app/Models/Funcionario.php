<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'celular',
        'conhecimentos',
        'status',
        'validado_em'
    ];

    protected $dates = [
        'validado_em',
        'created_at',
        'updated_at'
    ];

    protected $enum = [
        'conhecimentos' => [
            'Git',
            'React',
            'PHP',
            'NodeJS',
            'DevOps',
            'Banco de Dados',
            'TypeScript'
        ],
        'status' => [
            'Não validado',
            'Validado'
        ]
    ];

    public function getEnums()
    {
        return $this->enum;
    }
}
