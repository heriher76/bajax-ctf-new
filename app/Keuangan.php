<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
	protected $table = 'keuangan';
    protected $fillable = [
        'keterangan', 'harga', 'tipe',
    ];
}
