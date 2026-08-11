<?php

namespace App\Http\Controllers;

use App\Models\FinalStatus;
use Illuminate\Http\Request;

class FinalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finalStatuses = FinalStatus::latest()->get();

        return view('final-statuses.index', compact('finalStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('final-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:final_statuses,name'],
        ]);

        FinalStatus::create($validated);

        return redirect()
            ->route('final-status.index')
            ->with('success', 'Final status created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinalStatus $finalStatus)
    {
        return view('final-statuses.edit', compact('finalStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinalStatus $finalStatus)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:final_statuses,name,' . $finalStatus->id],
        ]);

        $finalStatus->update($validated);

        return redirect()
            ->route('final-status.index')
            ->with('success', 'Final status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinalStatus $finalStatus)
    {
        $finalStatus->delete();

        return redirect()
            ->route('final-status.index')
            ->with('success', 'Final status deleted successfully.');
    }
}
