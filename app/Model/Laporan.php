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
        'biaya_lain_id',
        'invoice_nota_id',
        'modal',
        'laporan_total'
    ];
}
