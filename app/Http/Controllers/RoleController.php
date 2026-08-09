<?php

namespace App\Http\Controllers;

use App\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class RoleController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('role.index');
    }


    public function dataTable()
    {
        $query = Role::query();
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function (Role $role) {
                $btn = '';
                $btn .= ' <a href="' . route('role.edit', ['role' => encrypt_value($role->id)]) . '" class="btn btn-outline-secondary btn-sm edit" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= ' <a role="button" data-id="' . $role->id . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions = Permission::with('children')
            ->orderBy('sort')
            ->whereNull('parent_id')
            ->get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'permission' => 'required|array', // array of permission names or IDs
        ]);

        DB::beginTransaction();

        try {
            // Create role
            $role = Role::create([
                'name' => $request->name,
            ]);

            // Assign permissions
            // If your checkboxes have permission names:
            // $role->givePermissionTo($request->permission);

            // If your checkboxes have permission IDs instead, use:
            $permissions = Permission::whereIn('id', $request->permission)->get();
            $role->givePermissionTo($permissions);

            DB::commit();

            return redirect()->route('role.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('role.create')->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
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

        $role = Role::findOrFail(decrypt_value($id));
        $permissions = Permission::with('children')
            ->orderBy('sort')
            ->whereNull('parent_id')
            ->get();
        return view('role.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permission' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);

        // Sync permissions
        $permissions = Permission::whereIn('id', $request->permission)->get(); // if using IDs
        $role->syncPermissions($permissions);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            // Delete the role; Spatie handles pivot table cleanup automatically
            $role->delete();

            return response()->json(['success' => true, 'message' => 'Role deleted successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 200);
        }
    }

    public function userAssignRole()
    {
        $roles = Role::all();
        $users = User::where('status', '1')->get();
        return view('role.user_assign_role', compact('roles', 'users'));
    }
    public function userAssignRoleStore(Request $request)
    {
        // return($request->all());
        $request->validate([
            'role' => 'required|string|exists:roles,id', // ensure role exists
        ]);

        $user = User::findOrFail($request->user);
        $role = Role::findOrFail($request->role);
        // dd($user, $role);
        $user->update([
            'role' => strtolower($role->name),
        ]);
        // Sync role: replaces old role with new
        $user->syncRoles([$role]);

        return redirect()->route('role.index')->with('success', 'User role updated successfully.');
    }
}
