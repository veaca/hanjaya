<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public function invoiceNotas(){
        return $this->hasMany(InvoiceNota::class);
    }

    public function biayaLains(){
        return $this->hasMany(BiayaLain::class);
    }

    protected $fillable = [
        'bulan',
        'tahun',
        'laporan_biaya_bulanan',
        'laporan_invoice',
        'laporan_nota',
        'laporan_total'
    ];
}
