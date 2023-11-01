<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view("admin.users.index", compact("users"));
    }

    public function create()
    {
        return view("admin.users.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'=> 'required|unique:users|email',
            'password'=> 'required|min:6|max:32',
            'confirm' => 'same:password',
            'is_admin' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        Session::flash('success','Create user successful');
        return redirect()->route('admin.users.index');
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'is_admin' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'is_admin' => $request->is_admin, 
        ];
        if($request->password){    
            $this->validate($request, [
                'password'=> 'required|min:6|max:32',
                'confirm' => 'same:password',
            ]);
            $data['password'] = bcrypt($request->password);
        }

        $user = User::find($id);
        $user->update($data);
        Session::flash('success','Update user successful');
        return redirect()->route('admin.users.index');
    }

    public function delete(string $id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success','Delete user successful');
        return redirect()->route('admin.users.index');
    }
}
