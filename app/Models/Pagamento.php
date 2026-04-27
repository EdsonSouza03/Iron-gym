<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'status',
        'valor',
        'data_vencimento',
        'user_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'user_id');
    }
}
