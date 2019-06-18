<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceVendor extends Model
{
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    
    protected $fillable = [
        'invoice_id',
        'vendor_id'
    ];
}
