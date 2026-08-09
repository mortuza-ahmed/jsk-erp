<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index');
    }

    public function dataTable()
    {
        $query = User::query();
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function (User $user) {
                $btn = '';
                $btn .= ' <a href="' . route('user.edit', ['user' => encrypt_value($user->id)]) . '" class="btn btn-outline-secondary btn-sm edit" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= ' <a role="button" data-id="' . $user->id . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></a>';
                return $btn;
                // return dropdownMenuContainer($btn);
            })
            ->addColumn('status', function (User $user) {
                if ($user->status == 1)
                    return '<span class="badge bg-success">Active</span>';
                else
                    return '<span class="badge bg-danger">Inactive</span>';
            })
            ->editColumn('role', function (User $user) {
                return $user->role ?? 'Not Assign';
            })
            ->rawColumns(['action', 'status', 'role'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')
            ],
            'mobile_no' => [
                'required',
                'max:255',
                Rule::unique('users')
            ],
            'password' => ['required', 'confirmed', Password::defaults()],
            'status' => 'nullable|boolean', // Ensure 'status' is boolean
        ]);
        // return($request->all());
        DB::beginTransaction();

        try {
            $validatedData['password'] = bcrypt($request->password);
            $validatedData['created_by'] = auth()->id();

            $user = User::create($validatedData);
            // $user->syncPermissions($request->permission);

            DB::commit();


            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('user.create')->with('error', 'An error occurred while creating the user : ' . $e->getMessage())->withInput();
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
    {;
        $user = User::findOrFail(decrypt_value($id));
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'mobile_no' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'status' => 'nullable|boolean', // Ensure 'status' is boolean
        ]);
        // return($request->all());
        DB::beginTransaction();

        try {
            $validatedData['password'] = $request->password ? bcrypt($request->password) : $user->password;
            $validatedData['updated_by'] = auth()->id();

            $user->update($validatedData);
            // $user->syncPermissions($request->permission);

            DB::commit();


            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('user.create')->with('error', 'An error occurred while creating the user : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->update([
                'deleted_by' => auth()->id(),
            ]);
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 200);
        }
    }
}
