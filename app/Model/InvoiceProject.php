<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProject extends Model
{
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    protected $fillable = [
        'invoice_id',
        'project_id'
    ];
}
