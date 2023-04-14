<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\User\CreateUserRequest;
use App\Http\Requests\admin\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserCntroller extends Controller
{
   
    public function index()
    {
        $users = User::simplePaginate(5);
        return view('users.index')->with(['users'=> $users]);
    }

    
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);  
        return view('users.show')->with(['user'=> $user]);
    }

    public function create(Request $request){
        return view('users.create');
    }
   
    public function show(string $id)
    {
        $users = User::find($id);
        return view('users.show')->with(['user'=> $users]);
    }

    public function edit(Request $request, string $id)
    {
        $user = User::find($id);
        return view('users.edit')->with(['user'=> $user]);
    }

    public function update(UpdateUserRequest $request , string $id){
        $user = User::query()->where('id',$id)->first();
        $user->update([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return view('users.show')->with(['user'=> $user]);
    }
    
    public function destroy(string $id)
    {
        User::find($id)->delete();
        $users = User::simplePaginate(5);
        return view('users.index')->with(['users'=> $users]);
    }
}
