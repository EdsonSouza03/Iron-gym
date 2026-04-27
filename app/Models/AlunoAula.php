<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoAula extends Model
{
    protected $table = 'aluno_aula';

    protected $fillable = [
        'aluno_id',
        'aula_id',
        'status',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}
