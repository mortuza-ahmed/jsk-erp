<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
        if ($request->filled('from_date')) {
            $query->whereDate('initiate_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('initiate_date', '<=', $request->to_date);
        }
        $projects = $query->latest()->get();
        return view('project.index', compact('projects'));
    }
    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name'       => 'required|string|max:255',
            'country'            => 'required|string',
            'company_name'       => 'required|string|max:255',
            'waqala_visa_number' => 'required|string|max:100',
            'profession'         => 'required|string|max:100',
            'ref_no'             => 'nullable|string|max:100|unique:projects,ref_no',
            'initiate_date'      => 'required|date',
        ]);

        try {
            Project::create($validated);

            return redirect()
                ->route('projects.index')
                ->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the project.');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        return view('project.edit', compact('project'));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'project_name'       => 'required|string|max:255',
            'country'            => 'required|string',
            'company_name'       => 'required|string|max:255',
            'waqala_visa_number' => 'required|string|max:100',
            'profession'         => 'required|string|max:100',
            'ref_no'             => 'nullable|string|max:100|unique:projects,ref_no,' . $project->id,
            'initiate_date'      => 'required|date',
        ]);

        try {
            $project->update($validated);

            return redirect()
                ->route('projects.index')
                ->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating the project.');
        }
    }

    public function toggleStatus(string $id)
    {
        $project = Project::findOrFail($id);

        $project->status = $project->status == 'activated' ? 'closed' : 'activated';
        $project->save();

        return response()->json([
            'status'  => $project->status,
            'message' => 'Status updated successfully.',
        ]);
    }
    public function collection_entry()
    {
        $projects = Project::where('status', 'activated')->latest()->get();

        $agentsJson = '[{"id":1,"name":"Agent 1"},{"id":2,"name":"Agent 2"}]';
        $agents = json_decode($agentsJson, true);

        $categoriesJson = '[{"id":1,"name":"CASHIER"},{"id":2,"name":"CLEANER"},{"id":3,"name":"CONSTRUCTION"},{"id":4,"name":"FUEL FILLER"},{"id":5,"name":"KITCHEN WORKER"},{"id":6,"name":"RESTAURANT"},{"id":7,"name":"RESTAURANT WORKER"},{"id":8,"name":"STORE IN CHARGE"},{"id":9,"name":"SUPERVISOR"},{"id":10,"name":"TAXI DRIVER"}]';
        $categories = json_decode($categoriesJson, true);

        $finalStatusJson = '[
            { "id": 1, "name": "STAMPING DONE" },
            { "id": 2, "name": "DECISION PENDING" },
            { "id": 3, "name": "READY FOR EMBASSY" },
            { "id": 4, "name": "NOT INTERESTED TO INTERESTED" },
            { "id": 5, "name": "NEED MOFA,TASHEER" },
            { "id": 6, "name": "NEEP MOFA,TASHEER,PAYMENT" },
            { "id": 7, "name": "SWITCH TO MEHAN" },
            { "id": 8, "name": "MOFA TASHEER DONE, PC PROBLEM" },
            { "id": 9, "name": "RENEW PASSPORT RECEIVE (27.07.26)" },
            { "id": 10, "name": "NEED PC,READY FOR EMBASSY" },
            { "id": 11, "name": "AL-BAIK" },
            { "id": 12, "name": "CONERETED TO SASCO" },
            { "id": 13, "name": "MOFA,TASHEER THEN READY" },
            { "id": 14, "name": "KFC CONVERTED" },
            { "id": 15, "name": "READY FOR EMBASSY BUT AGENT PROBLEM" },
            { "id": 16, "name": "UNDER AGE" },
            { "id": 17, "name": "PAYMANT ISSUE" },
            { "id": 18, "name": "SUBMIT NEXT WEEK" },
            { "id": 19, "name": "NEED PC" },
            { "id": 20, "name": "READY FOR EMBASSAY" },
            { "id": 21, "name": "NO RESPONSE" },
            { "id": 22, "name": "SELECTED IN SASCO" },
            { "id": 23, "name": "NEED MONEY,THEN READY FOR EMBASSY" },
            { "id": 24, "name": "AGE WILL BE 21 AUGUST 5 NEED MONEY,THEN READY FOR EMBASSY" },
            { "id": 25, "name": "FINGER BLOCK" },
            { "id": 26, "name": "NEED MONEY,READY FOR EMBASSY" },
            { "id": 27, "name": "NEED MOFA, TASHEER" },
            { "id": 28, "name": "PASSPORT LOST" },
            { "id": 29, "name": "RESULT PUBLISHED ON 14.07.2026" },
            { "id": 30, "name": "NEED PASSPORT RENEW" },
            { "id": 31, "name": "MOFA,TASHEER" },
            { "id": 32, "name": "NEED MEDICAL READY FOR EMBASSY" },
            { "id": 33, "name": "MISINFORMATION ABOUT SALARY" },
            { "id": 34, "name": "INTERESTED FOR PHARMACY" }
        ]';
        $finalStatus = json_decode($finalStatusJson, true);

        $companiesJson = '[
            { "id": 1, "name": "AL-MAWARID" },
            { "id": 2, "name": "DOMINOS" },
            { "id": 3, "name": "KABI TAXI" },
            { "id": 4, "name": "KFC" },
            { "id": 5, "name": "SASCO" },
            { "id": 6, "name": "AL MAWARID" }
        ]';
        $companies = json_decode($companiesJson, true);

        return view('project.collection_entry', compact('projects', 'agents', 'categories', 'finalStatus', 'companies'));
    }

    public function destroy(string $id)
    {
        //
    }
}
