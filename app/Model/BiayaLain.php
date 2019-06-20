<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiayaLain extends Model
{
    public function laporan(){
        return $this->belongsTo(Laporan::class);
    }

    protected $fillable = [
        'gaji',
        'bpjs',
        'bank',
        'listrik',
        'pdam'
    ];
}
