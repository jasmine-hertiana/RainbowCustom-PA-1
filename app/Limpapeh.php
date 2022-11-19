<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Limpapeh extends Model
{
    protected $table = "limpapeh";
    protected $fillable = [
        'id','nosw','nama','nik','alamat','notelp','memo','tglsewa','tglkembali','jmlsewa','denda','total'
    ];
}
