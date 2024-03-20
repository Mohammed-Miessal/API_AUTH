<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('role:Super Admin,Admin', ['only' => ['ShowDetails']]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreUserRequest $request)
    {
        $request = $request->validated();

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if (isset($request['role_id'])) {
            $user->roles()->sync($request['role_id']);
        }

        if (isset($request['permission_id'])) {
            $user->permissions()->sync($request['permission_id']);
        }

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }


    public function show(User $user)
    {
        $user = User::find($user->id);
        return response()->json([
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        //
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $request = $request->validated();

        $user = User::find($user->id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if (isset($request['role_id'])) {
            $user->roles()->sync($request['role_id']);
        }

        if (isset($request['permission_id'])) {
            $user->permissions()->sync($request['permission_id']);
        }

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }

    public function ShowDetails()
    {
        $user = auth()->user();
        $name = auth()->user()->name;
        $email = auth()->user()->email;

        return response()->json([
            'message' => 'User details',
            'name' => $name,
            'email' => $email,
            'roles' => $user->roles()->pluck('name'),
            'permissions' => $user->permissions()->pluck('name')
        ]);
    }
}
