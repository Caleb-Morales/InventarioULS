<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->input('nombre')]);

        return redirect()->route('permission.index');
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->input('nombre')]);

        return redirect()->route('permission.index');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permission.index');
    }
}
