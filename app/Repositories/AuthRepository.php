<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    public function create($data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                // Sync roles
                if (isset($data['role_id'])) {
                    $roles = Role::find($data['role_id']);
                    $user->roles()->sync($roles);
                }

                // Sync permissions
                if (isset($data['permission_id'])) {
                    $permissions = Permission::find($data['permission_id']);
                    $user->permissions()->sync($permissions);
                }

                return $user;
            });
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function logout()
    {
        Auth::logout();

        return [
            'message' => 'Successfully logged out',
        ];
    }

    public function refresh()
    {
        return [
            'message' => 'Token refreshed successfully',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ];
    }
}
