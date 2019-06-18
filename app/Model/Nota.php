<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function vendor()
    {
        return $this->belongsTo(NotaVendor::class);
    }

    public function customer()
    {
        return $this->belongsTo(NotaCustomer::class);
    }

    public function notadetails()
    {
        return $this->hasMany(NotaNotaDetail::class);
    }

    protected $fillable = [
        'customer_id',
        'vendor_id',
        'tanggal',
        'asal',
        'tujuan',
        'NOP'
    ];
}
