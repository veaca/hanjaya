<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nop',
        'spk',
        'customer_id',
        'asal',
        'tujuan',
        'tarif',
        'qty',
        'tarif_vendor',
        'nilai_project'
    ];
}
