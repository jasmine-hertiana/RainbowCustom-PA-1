<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    protected $table = "buku_besar";
    protected $fillable = [
        'id', 'idtrans', 'notran', 'catatan', 'jmldb', 'jmlcr'
    ];
}
