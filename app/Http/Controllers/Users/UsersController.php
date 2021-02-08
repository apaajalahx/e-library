<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Level;
class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(10);
        return view('users.users', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => "required|max:255",
            "email" => "required|max:255",
            "password" => "required|min:8",
            "role" => "required|max:225",
        ]);
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = Hash::make($request->password);
        User::create($user);
        $user_id = User::where("email",$user['email'])->first()->id;
        Level::insert(["users_id" => $user_id, "level_name" => $request->role]);
        return redirect()->back()->with("success","success add users");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->get();
        return view('users.edit', ['users' => $user]);
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
        $this->validate($request,[
            "name" => "required|max:255",
            "email" => "required|max:255",
            "role" => "required|max:225",
            "id" => "required|max:255",
            "password" => "max:",
        ]);
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        if(!$request->password == ''){
            $user['password'] = Hash::make($request->password);
        }
        $user_find = User::where("id",$request->id)->first();
        if(!is_null($user_find)){
            User::where("id",$request->id)->update($user);
            /**
             * style like this coz if use function update it will be automatic add column updated_at.
             */
            $level = Level::where("users_id",$request->id)->first();
            $level->timestamps = false;
            $level->level_name = $request->role;
            $level->save();
            return redirect()->back()->with("success","success edit users ".$request->id);
        }
        return redirect()->back()->with("success","Failed    edit users ".$request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        $level = Level::where('users_id', $id)->first();
        if(!is_null($level)){
            $level->delete();
        }
        return redirect()->route('user_list')->with("deleted","Users ".$id." Success Deleted");
    }
}
