<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.account',compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $oldUser=Auth::user();
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.Auth::id()],
            'password' => ['confirmed'],

            'name' => ['required', 'string', 'max:191'],
            'avatar' => ['image','max:2048'],
            'birthplace' => ['required','string','max:191'],
            'dateofbirth' => ['required','date_format:Y-m-d'],
            'address' => ['required','string'],
            'website' => ['max:191'],
            'visible' => 'required',
        ]);


        $data = $request->all();
        $input=[
            'email' => $data['email'],
            'name' => $data['name'],
            'birthplace' => $data['birthplace'],
            'dateofbirth' => $data['dateofbirth'],
            'aboutme' => $data['aboutme'],
            'address' => $data['address'],
            'website' => $data['website'],
            'visible' => $data['visible'],
        ];

        if($data['email'] != $oldUser->email){
            $input['email_verified_at']=null;
        }
        if(!empty($data['password'])){ 
            $input['password'] = Hash::make($data['password']);
        }

        $user = User::find(Auth::id());
        $user->update($input);

        if(!empty($data['avatar'])){ 
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        return redirect()->route('account')
                        ->with('success','Account updated successfully');
    }
}
