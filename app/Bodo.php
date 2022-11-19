<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodo extends Model
{
    protected $table = "bodo";
    protected $fillable = [
        'id','nosw','nama','nik','alamat','notelp','memo','tglsewa','tglkembali','jmlsewa','denda','total'
    ];
}
