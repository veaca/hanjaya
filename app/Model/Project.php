<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected $fillable = [
        'name',
        'info',
        'tarif',
        'jumlah'
    ];
}
