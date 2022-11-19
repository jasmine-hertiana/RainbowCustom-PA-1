<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    protected $table = "kas_masuk";
    protected $fillable = [
        'id','nokm','tglkm','memokm','jmkm'
    ];
}
