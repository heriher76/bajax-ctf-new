<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Challenge;
use App\ChallengeLog;
use Auth;

class ChallengeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:challenge-create', ['only' => ['create','store']]);
         $this->middleware('permission:challenge-edit', ['only' => ['destroyFile','edit','update']]);
         $this->middleware('permission:challenge-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listChallenges = Challenge::orderBy('id','ASC')->get();
        $challenges=array();
        foreach ($listChallenges as $challenge) {
            $challengeLog=ChallengeLog::where(['user_id' => Auth::id(),'challenge_id' => $challenge->id])->count();
            if($challengeLog)
                $challenges[]=array("data"=>$challenge,"finished"=>true);
            else 
                $challenges[]=array("data"=>$challenge,"finished"=>false);
        }
        return view('challenge.index',compact('challenges'))
            ->with('i', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('challenge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'point' => 'required|integer',
            'note' => 'required',
            'flag' => 'required|max:191',
            'file1' => 'max:2048',
            'file2' => 'max:2048',
            'file3' => 'max:2048',
            'file4' => 'max:2048',
        ]);
        
        $data=$request->all();        
        $input=[
            'name' => $data['name'],
            'point' => $data['point'],
            'note' => $data['note'],
            'flag' => $data['flag'],
        ];
        
        if($request->file('file1')){
            $file1=$request->file('file1')->getClientOriginalName();
            $input['file1']=$file1;
        }
        if($request->file('file2')){
            $file2=$request->file('file2')->getClientOriginalName();
            $input['file2']=$file2;
        }
        if($request->file('file3')){
            $file3=$request->file('file3')->getClientOriginalName();
            $input['file3']=$file3;
        }
        if($request->file('file4')){
            $file4=$request->file('file4')->getClientOriginalName();
            $input['file4']=$file4;
        }
        $idChallenge = Challenge::create($input);

        if($request->file('file1')){
            Storage::disk('challenges')->putFileAs($idChallenge->id, $request->file('file1'), $file1);
        }
        if($request->file('file2')){
            Storage::disk('challenges')->putFileAs($idChallenge->id, $request->file('file2'), $file2);
        }
        if($request->file('file3')){
            Storage::disk('challenges')->putFileAs($idChallenge->id, $request->file('file3'), $file3);
        }
        if($request->file('file4')){
            Storage::disk('challenges')->putFileAs($idChallenge->id, $request->file('file4'), $file4);
        }

        return redirect()->route('challenge.index')
                        ->with('success','Challenge created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challenge = Challenge::find($id);
        $challengeLog=ChallengeLog::where(['user_id' => Auth::id(),'challenge_id' => $id])->count();
        $urlFile=array();
        $urlFile[1]=Storage::disk('challenges')->url($id.'/'.$challenge->file1);
        $urlFile[2]=Storage::disk('challenges')->url($id.'/'.$challenge->file2);
        $urlFile[3]=Storage::disk('challenges')->url($id.'/'.$challenge->file3);
        $urlFile[4]=Storage::disk('challenges')->url($id.'/'.$challenge->file4);


        return view('challenge.show',compact('challenge','urlFile','challengeLog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $challenge=Challenge::find($id);
        return view('challenge.edit',compact('challenge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'point' => 'required|integer',
            'note' => 'required',
            'flag' => 'required|max:191',
            'file1' => 'max:2048',
            'file2' => 'max:2048',
            'file3' => 'max:2048',
            'file4' => 'max:2048',
        ]);
        
        $data=$request->all();        
        $input=[
            'name' => $data['name'],
            'point' => $data['point'],
            'note' => $data['note'],
            'flag' => $data['flag'],
        ];
        
        if($request->file('file1')){
            $file1=$request->file('file1')->getClientOriginalName();
            $input['file1']=$file1;
        }
        if($request->file('file2')){
            $file2=$request->file('file2')->getClientOriginalName();
            $input['file2']=$file2;
        }
        if($request->file('file3')){
            $file3=$request->file('file3')->getClientOriginalName();
            $input['file3']=$file3;
        }
        if($request->file('file4')){
            $file4=$request->file('file4')->getClientOriginalName();
            $input['file4']=$file4;
        }
        $idChallenge = Challenge::find($id)->update($input);

        if($request->file('file1')){
            Storage::disk('challenges')->putFileAs($id, $request->file('file1'), $file1);
        }
        if($request->file('file2')){
            Storage::disk('challenges')->putFileAs($id, $request->file('file2'), $file2);
        }
        if($request->file('file3')){
            Storage::disk('challenges')->putFileAs($id, $request->file('file3'), $file3);
        }
        if($request->file('file4')){
            Storage::disk('challenges')->putFileAs($id, $request->file('file4'), $file4);
        }

        return redirect()->route('challenge.index')
                        ->with('success','Challenge edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = Challenge::find($id)->delete();
        Storage::disk('challenges')->deleteDirectory($id);
        return redirect()->route('challenge.index')
                        ->with('success','Challenge deleted successfully');
    }
    public function destroyFile($id,$file)
    {
        $challenge = Challenge::find($id);        
        if ($challenge) {
            if($challenge->{$file}){
                Storage::disk('challenges')->delete($id.'/'.$challenge->{$file});
                $challenge->update([$file => ""]);
                return redirect()->route('challenge.edit',['id'=>$id])
                        ->with('success','Delete file successfully');
            }
            else
                return redirect()->route('challenge.edit',['id'=>$id]);
        }
        else
            return redirect()->route('home');

    }
}
