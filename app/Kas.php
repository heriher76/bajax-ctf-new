<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
	protected $table = 'kas';
    protected $fillable = [
        'user_id', 'bayar', 'bulan', 'tahun', 'minggu'
    ];
}
