<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurung extends Model
{
    protected $table = "kurung";
    protected $fillable = [
        'id','nosw','nama','nik','alamat','notelp','memo','tglsewa','tglkembali','jmlsewa','denda','total'
    ];
}
