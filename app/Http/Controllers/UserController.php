<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    function index()
    {
        $users = User::all();
        return view('/users/index', compact('users'));
    }

    function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required|min:0',
        ]);

        // hash password
        $hash = Hash::make($request->password);

        // create a new user 
        $data = Arr::except($request->all(), ['password']);
        User::create([...$data, 'password' => $hash]);

        return redirect()->route('post')->with('success', 'update thành công');
    }

    function create()
    {
        return view('/users/create');
    }

    function show($id)
    {
    }

    function edit($id)
    {
        $user = User::find($id);
        return view('/users/edit', compact('user'));
    }

    function update(Request $request, $id)
    {
        // hash password 
        $hash = Hash::make($request->password);

        User::where('id', '=', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $hash,
        ]);

        return redirect('/user');
    }

    function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return redirect()->route('post')->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            // return redirect()->route('post')->with('success', 'update thành công');
        }
    }
}
