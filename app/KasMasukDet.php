<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasMasukDet extends Model
{
    protected $table = "kas_masuk_det";
    protected $fillable = [
        'idkm','idakun','nildb'
    ];
}
