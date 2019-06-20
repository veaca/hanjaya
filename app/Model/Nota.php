<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function notaVendor()
    {
        return $this->belongsTo(NotaVendor::class);
    }

    public function InvoiceNota()
    {
        return $this->belongsTo(InvoiceNota::class);
    }

    public function notaNotaDetails()
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
