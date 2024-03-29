<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiayaLain extends Model
{
    

    protected $fillable = [
        'bulan',
        'tahun',
        'gaji',
        'bpjs',
        'bank',
        'listrik',
        'pdam',
        'atk',
        'biaya_lain'
    ];

    public function laporan(){
        return $this->belongsTo(Laporan::class);
    }
}
