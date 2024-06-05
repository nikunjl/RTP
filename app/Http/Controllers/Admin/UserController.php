<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Validator;
use Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage User | ' . env('APP_NAME');
        $users = User::get();
        return view('admin.user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create User | ' . env('APP_NAME');
        $rols = Role::all();
        return view('admin.user.create', compact('title','rols'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'   => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required'
        ]);      
      
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->mobile_no = $request->mobile_no;
        $user->status = $request->status;
        $user->password = Hash::make('123456');//$request->password;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit User | ' . env('APP_NAME');
        $user = User::find($id);
        $rols = Role::all();
        return view('admin.user.edit', compact('user', 'title','rols'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name'   => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_no' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->mobile_no = $request->mobile_no;
        $user->status = $request->status;
        // $user->password = $request->password;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Record updated!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->delete();
        return redirect()->route('user.index')->with('success', 'Record deleted!.');
    }
}
