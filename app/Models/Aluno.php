<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
    ];

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'user_id');
    }
}
