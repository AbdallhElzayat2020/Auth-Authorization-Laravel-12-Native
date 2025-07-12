<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with(['permissions'])->get();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name', 'min:2', 'max:50']
        ]);
        $role = Role::create([
            'name' => $request->name,
        ]);
        if (!$role->save()) {
            return redirect()->back()->with('error', 'Failed to create role');
        }
        return redirect()->back()->with('success', 'Role created successfully');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role not found');
        }
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id, 'min:2', 'max:50']
        ]);
        $role->update([
            'name' => $request->name,
        ]);
        if (!$role->save()) {
            return redirect()->back()->with('error', 'Failed to update role');
        }
        return redirect()->back()->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role not found');
        }
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Role cannot be deleted because it is assigned to users');
        }
        if (!$role->delete()) {
            return redirect()->back()->with('error', 'Failed to delete role');
        }
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully');
    }
}
