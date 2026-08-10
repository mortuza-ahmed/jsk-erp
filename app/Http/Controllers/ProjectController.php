<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use App\Models\Agency;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Company;
use App\Models\FinalStatus;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function collection_view($id)
    {
        $project = Project::findOrFail($id);
        $collections = Collection::with('project','agency','category_info','final_status','entry_final_status','company','fcompany')->where('project_id', $id)->orderBy('created_at', 'asc')->get();
        return view('project.collection_view', compact('project', 'collections'));
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
        [$agents, $categories, $finalStatus, $companies] = $this->collectionEntryLookups();

        return view('project.collection_entry', compact('projects', 'agents', 'categories', 'finalStatus', 'companies'));
    }

    public function store_collection_entry(Request $request)
    {
        $validated = $this->validateCollectionEntry($request);

        Collection::create($validated);

        return redirect()
            ->route('projects.collectionEntry')
            ->with('success', 'Candidate entry saved successfully.');
    }

    public function collection_entry_edit(string $id)
    {
        $collection = Collection::findOrFail($id);
        $projects = Project::where('status', 'activated')->latest()->get();
        [$agents, $categories, $finalStatus, $companies] = $this->collectionEntryLookups();

        return view('project.collection_entry', compact('collection', 'projects', 'agents', 'categories', 'finalStatus', 'companies'));
    }

    public function update_collection_entry(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);

        $validated = $this->validateCollectionEntry($request);

        $collection->update($validated);

        return redirect()
            ->route('projects.collectionView', $collection->project_id)
            ->with('success', 'Candidate entry updated successfully.');
    }

    public function destroy_collection_entry(string $id)
    {
        $collection = Collection::findOrFail($id);
        $projectId = $collection->project_id;

        $collection->delete();

        return redirect()
            ->route('projects.collectionView', $projectId)
            ->with('success', 'Candidate entry deleted successfully.');
    }

    public function collectionExport(Project $project)
    {
        $collections = Collection::where('project_id', $project->id)->get();
        return Excel::download(
            new CollectionExport($project, $collections),str_replace(' ', '-', $project->project_name) . '.xlsx'
        );
    }

    public function destroy(string $id)
    {
        //
    }

    /**
     * Shared validation rules for collection entry store & update.
     */
    private function validateCollectionEntry(Request $request): array
    {
        return $request->validate([
            // Top fields
            'project_id' => 'required|exists:projects,id',
            'name'       => 'required|string|max:255',
            'pp_no'      => 'nullable|string|max:100',
            'phone_no'   => 'nullable|string|max:50',

            // Passport Collection (Interview)
            'interview_date_from' => 'nullable|date',
            'age'                 => 'nullable|integer|min:18|max:60',
            'agent_id'            => 'nullable|integer',
            'status'              => 'nullable|in:SELECTED,FINAL SELECTED',
            'category'            => 'nullable|integer',
            'medical'             => 'nullable|string|max:255',
            'takamul'             => 'nullable|string|max:255',
            'pc'                  => 'nullable|string|max:255',
            'dl'                  => 'nullable|in:NEED DL,OK',
            'final_status_id'     => 'nullable|integer',
            'company_id'          => 'nullable|integer',

            // Passport Entry, Ready
            's_entry'             => 'nullable|string|max:255',
            'entry_date'          => 'nullable|date',
            'pic'                 => 'nullable|in:YES,NO',
            'tasheer'             => 'nullable|string|max:255',
            'entry_final_status'  => 'nullable|integer',

            // MOFA Section
            'mofa_date'           => 'nullable|date',
            'mofa_status'         => 'nullable|in:DONE,PENDING',
            'comments'            => 'nullable|string',

            // Visa Management
            'f_company_id'          => 'nullable|integer',
            'sent_for_mofa_agency'    => 'nullable|string|max:255',
            'occupation'              => 'nullable|string|max:255',
            'visa_inport'             => 'nullable|string|max:255',
            'status_in_visa_section'  => 'nullable|in:READY FOR EMBASSY',
            'embassy_handover'        => 'nullable|date',

            // Embassy Section
            'stamping'            => 'nullable|in:STAMPING DONE,PENDING',

            // Manpower
            'training'            => 'nullable|in:DONE,PENDING',
            'finger'              => 'nullable|in:DONE,PENDING',
            'man_p'               => 'nullable|string|max:255',

            // Flight
            'f_date_from'         => 'nullable|date',
            'exp_date'            => 'nullable|date',

            // Delivery Section
            'fit_card'                  => 'nullable|in:DONE,PENDING',
            'hand_over_to_visa_section' => 'nullable|in:DONE,PENDING',
            'delivery'                  => 'nullable|in:DONE,PENDING',
            'delivery_date'             => 'nullable|date',
        ]);
    }

    /**
     * Shared dropdown data for collection entry form (create & edit).
     */
    private function collectionEntryLookups(): array
    {
        $agents = Agency::get();
        $categories = Category::get();
        $finalStatus = FinalStatus::get();
        $companies = Company::get();
        return [$agents, $categories, $finalStatus, $companies];
    }
}
