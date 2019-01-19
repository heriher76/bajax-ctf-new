<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:user-list');
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(12);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 12);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

            'name' => ['required', 'string', 'max:191'],
            'avatar' => ['required','image','max:2048'],
            'birthplace' => ['required','string','max:191'],
            'dateofbirth' => ['required','date_format:Y-m-d'],
            'address' => ['required','string'],
            'website' => ['max:191'],
            'roles' => 'required',
            'visible' => 'required',
        ]);

        $data = $request->all();

        $input=[
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            'name' => $data['name'],
            'birthplace' => $data['birthplace'],
            'dateofbirth' => $data['dateofbirth'],
            'aboutme' => $data['aboutme'],
            'address' => $data['address'],
            'website' => $data['website'],
            'visible' => $data['visible'],
        ];
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
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
        $oldUser=User::find($id);
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$id],
            'password' => ['confirmed'],

            'name' => ['required', 'string', 'max:191'],
            'avatar' => ['image','max:2048'],
            'birthplace' => ['required','string','max:191'],
            'dateofbirth' => ['required','date_format:Y-m-d'],
            'address' => ['required','string'],
            'website' => ['max:191'],
            'roles' => 'required',
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

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        if(!empty($data['avatar'])){ 
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != 1){
            User::find($id)->delete();
            return redirect()->route('users.index')
                            ->with('success','User deleted successfully');
        }
    }
}