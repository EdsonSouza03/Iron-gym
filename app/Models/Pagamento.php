<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'usuario',
        'status',
        'valor',
        'data_vencimento',
    ];
}
