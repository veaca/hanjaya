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

    public function invoiceNota()
    {
        return $this->belongsTo(InvoiceNota::class);
    }

    protected $fillable = [
        'tanggal',
        'nomor',
        'info',
        'project_id',
        'jumlah_ppn',
        'jumlah_invoice'
    ];
}
