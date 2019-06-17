<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function projects()
    {
        return $this->hasMany(Projects::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    protected $fillable = [
        'customer_id',
        'vendor_id',
        'tanggal',
        'number',
        'jumlah',
        'pajak',
        'jumlah_total'
    ];
}
