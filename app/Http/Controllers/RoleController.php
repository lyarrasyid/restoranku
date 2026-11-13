<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name',
            'description' => 'required|string|max:255',
        ],
        [
            'role_name.required' => 'Nama role harus diisi.',
            'role_name.string' => 'Nama role harus berupa teks.',
            'role_name.max' => 'Nama role tidak boleh lebih dari 255 karakter.',
            'role_name.unique' => 'Nama role sudah digunakan. Silakan pilih nama lain.',
            'description.required' => 'Deskripsi role harus diisi.',
            'description.string' => 'Deskripsi role harus berupa teks.',
            'description.max' => 'Deskripsi role tidak boleh lebih dari 255 karakter.',
        ]
        );

        Role::create($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $validatedData = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name,' . $role->id,
            'description' => 'required|string|max:255',
        ],
        [
            'role_name.required' => 'Nama role harus diisi.',
            'role_name.string' => 'Nama role harus berupa teks.',
            'role_name.max' => 'Nama role tidak boleh lebih dari 255 karakter.',
            'role_name.unique' => 'Nama role sudah digunakan. Silakan pilih nama lain.',
            'description.required' => 'Deskripsi role harus diisi.',
            'description.string' => 'Deskripsi role harus berupa teks.',
            'description.max' => 'Deskripsi role tidak boleh lebih dari 255 karakter.',
        ]
        );

        $role->update($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}
