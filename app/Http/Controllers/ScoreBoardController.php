<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Challenge;
use App\ChallengeLog;

class ScoreBoardController extends Controller
{
    public function index(){
    	$allScore=ChallengeLog::all();
    	$score=ChallengeLog::join('challenge', 'challenge.id', '=', 'challenge_log.challenge_id')
            ->join('users', 'users.id', '=', 'challenge_log.user_id')
            ->selectRaw('users.name, users.id, sum(challenge.point) as point, sum(challenge_log.created_at) as created_at')
            ->groupBy('users.id')
            ->orderBy('point', 'DESC')
            ->orderBy('challenge_log.created_at', 'DESC')
            ->limit(20)
            ->get();

        return view('score.index', compact('score'))->with('i',1);
    }
}
