<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kustin extends Model
{
    protected $table = "kustin";
    protected $fillable = [
        'id','nosw','nama','nik','alamat','notelp','memo','tglsewa','tglkembali','jmlsewa','denda','total'
    ];
}
