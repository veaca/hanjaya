<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaDetail extends Model
{
    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }

    protected $fillable = [
        'nota_id',
        'date',
        'nopol',
        'collies',
        'kg',
        'ongkos',
        'jumlah_ongkos'
    ];
}
