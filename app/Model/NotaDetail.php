<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaDetail extends Model
{
    protected $fillable = [
        'nota_id',
        'nopol',
        'kg',
        'ongkos'
    ];
}
