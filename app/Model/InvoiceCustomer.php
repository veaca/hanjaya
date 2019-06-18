<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceCustomer extends Model
{
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    protected $fillable = [
        'invoice_id',
        'customer_id'
    ];
}
