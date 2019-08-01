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
        'id',
        'vendor_id',
        'project_id',
        'tanggal',
        'jenis_tambahan',
        'jumlah_tambahan',
        'jumlah_pph',
        'ongkos_nota'
    ];
}
