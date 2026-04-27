<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = [
        'dia_semana',
        'horario',
        'atividade',
        'professor',
    ];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_aula')->withPivot('status')->withTimestamps();
    }
}
