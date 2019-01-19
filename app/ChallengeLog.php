<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeLog extends Model
{
	protected $table = 'challenge_log';
    protected $fillable = [
        'user_id','challenge_id','point',
    ];
}
