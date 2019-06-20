<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceNota extends Model
{
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function notas(){
        return $this->hasMany(Nota::class);
    }

    protected $fillable = [
        'invoice_id',
        'nota_id'
    ];
}
