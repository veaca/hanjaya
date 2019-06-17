<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function notadetails()
    {
        return $this->hasMany(NotaDetail::class);
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
