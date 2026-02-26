<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::latest()->get();

        return view('role_master.index', compact('roles'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully!');
    }

   
    public function edit($id)
    {
        $editRole = Role::findOrFail($id);   
        $roles = Role::latest()->get();

        return view('role_master.index', compact('editRole','roles'));
    }

   
    public function update(Request $request, $id)
    {
        $editRole = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
        ]);

        $editRole->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')
                         ->with('success', 'Role updated successfully!');
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Role deleted successfully!');
    }
}