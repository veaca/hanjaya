<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaNotaDetail extends Model
{
    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }

    protected $fillable = [
        'nota_id',
        'nota_detail_id'
    ];
}
