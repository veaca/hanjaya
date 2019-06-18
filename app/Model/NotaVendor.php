<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaVendor extends Model
{
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    protected $fillable = [
        'nota_id',
        'vendor_id'
    ];
}
