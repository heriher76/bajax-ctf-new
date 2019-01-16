<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JumlahUang extends Model
{
	protected $table = 'jumlah_uang';
    protected $fillable = [
        'uang',
    ];
}
