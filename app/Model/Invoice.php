<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function invoiceProjects()
    {
        return $this->hasMany(InvoiceProject::class);
    }

    public function invoiceCustomer()
    {
        return $this->belongsTo(InvoiceCustomer::class);
    }

    public function invoiceVendor()
    {
        return $this->belongsTo(InvoiceVendor::class);
    }

    protected $fillable = [
        'customer_id',
        'vendor_id',
        'tanggal',
        'nomor',
        'jumlah',
        'pajak',
        'jumlah_total'
    ];
}