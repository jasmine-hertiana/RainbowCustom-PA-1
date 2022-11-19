<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasKeluarDet extends Model
{
    protected $table = "kas_keluar_det";
    protected $fillable = [
        'idkk','idakun','nilcr'
    ];
}
