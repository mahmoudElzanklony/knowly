<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $types = [
        'owner' => 'Company',
        'admin' => 'Admin',
        'user' => 'User',
    ];
    public function index()
    {
        $users = User::all();
        $types = $this->types;
        return view('admin.users.index',compact('users' , 'types'));
    }

    public function create()
    {
        $types = $this->types;
        return view('admin.users.create',compact('types'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required|confirmed',
            'type' => 'required|in:admin,owner,user',
        ]);
        DB::beginTransaction();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;
        $user->save();

        DB::commit();
        return redirect()->route('admin.users.index')->with('success','User created successfully');
    }


    public function edit($id)
    {
        $user = User::find($id);
        $types = $this->types;
        return view('admin.users.edit',compact('user','types'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed',
            'type' => 'required|in:admin,owner,user',
        ]);
        DB::beginTransaction();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        DB::commit();
        return redirect()->route('admin.users.index')->with('success','User updated successfully');
    }


    public function destroy(User $user)
    {
        DB::beginTransaction();
        $user->articles()->delete();
        $user->delete();
        DB::commit();
        return redirect()->route('admin.users.index')->with('success','User deleted successfully');
    }
}
