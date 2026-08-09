<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permission.index');
    }


    public function dataTable()
    {
        $query = Permission::with('parent');
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function (Permission $permission) {
                $btn = '';
                $btn .= ' <a href="' . route('permission.edit', ['permission' => encrypt_value($permission->id)]) . '" class="btn btn-outline-secondary btn-sm edit" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= ' <a role="button" data-id="' . $permission->id . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></a>';
                return $btn;
                // return dropdownMenuContainer($btn);
            })
            ->addColumn('parent', function (Permission $permission) {
                return $permission->parent ? $permission->parent->name : 'No Parent';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:permissions,id',
            'sort' => 'nullable|integer|min:1',
        ]);

        Permission::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'sort' => $request->sort,
        ]);

        return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
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
    public function edit($id)
    {
        $permissions = Permission::all();
        $permission = Permission::findOrFail(decrypt_value($id));
        return view('permission.edit', compact('permissions', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:permissions,id',
            'sort' => 'nullable|integer|min:1',
        ]);

        $permission->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'sort' => $request->sort,
        ]);

        return redirect()->route('permission.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {

            $permission->delete();

            return response()->json(['success' => true, 'message' => 'Permission menu deleted successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 200);
        }
    }
}
