<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Challenge;
use App\ChallengeLog;
use Auth;

class ChallengeLogController extends Controller
{
    public function cekFlag($id, Request $request){
    	$challenge=Challenge::find($id);
    	$challengeLog=ChallengeLog::where(['user_id' => Auth::id(),'challenge_id' => $id])->count();
    	if(!$challengeLog){
	    	if($challenge->flag === $request->input('flag')){
	    		ChallengeLog::create([
	    			'user_id' => Auth::id(),
	    			'challenge_id' => $id,
	    		]);
		        return redirect()->route('challenge.show',['id'=>$id])
		            ->with('success','Success, +'.$challenge->point.' Point');
	    	}
	    	else 
		        return redirect()->route('challenge.show',['id'=>$id])->with('failed','Wrong Flag');
    	}
    	else
	        return redirect()->route('challenge.show',['id'=>$id])->with('failed','You Already Finished This Challenge');
    }
}
