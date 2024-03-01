<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Role::all();
        return response()->json([
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {

        $role = Role::find($role->id);
        return response()->json([
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        $role = Role::find($role->id);
        return response()->json([
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

        $role = Role::find($role->id);
        $role->name = $request->name;
        $role->save();
        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
    }
}
