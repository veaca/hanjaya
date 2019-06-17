<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    protected $fillable = [
        'name',
        'address',
        'phone'
    ];
}
