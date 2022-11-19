<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawi extends Model
{
    protected $table = "jawi";
    protected $fillable = [
        'id','nosw','nama','nik','alamat','notelp','memo','tglsewa','tglkembali','jmlsewa','denda','total'
    ];
}
