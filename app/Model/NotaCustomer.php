<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaCustomer extends Model
{
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    protected $fillable = [
        'nota_id',
        'customer_id'
    ];
}
