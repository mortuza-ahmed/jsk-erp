<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Top summary cards
        $stats = [
            [
                'label' => 'Active Projects',
                'value' => Project::where('status', 'activated')->count(),
                'icon'  => 'mdi-briefcase-outline',
            ],
            [
                'label' => 'Total Candidates',
                'value' => Collection::count(),
                'icon'  => 'mdi-account-group-outline',
            ],
            [
                'label' => 'Pending MOFA',
                'value' => Collection::whereNull('mofa_status')->count(),
                'icon'  => 'mdi-file-document-outline',
            ],
            [
                'label' => 'Delivered',
                'value' => Collection::whereNotNull('delivery_date')->count(),
                'icon'  => 'mdi-truck-check-outline',
            ],
        ];

        // Pipeline breakdown — where candidates currently sit in the process
        $pipeline = [
            'Passport Collection' => Collection::whereNull('entry_date')->count(),
            'Passport Entry'      => Collection::whereNotNull('entry_date')->whereNull('mofa_date')->count(),
            'MOFA'                => Collection::whereNotNull('mofa_date')->whereNull('embassy_handover')->count(),
            'Embassy / Visa'      => Collection::whereNotNull('embassy_handover')->whereNull('f_date_from')->count(),
            'Manpower'            => Collection::whereNotNull('f_date_from')->whereNull('delivery_date')->count(),
            'Delivered'           => Collection::whereNotNull('delivery_date')->count(),
        ];

        // Recent candidates
        $recentCollections = Collection::with('project')
            ->latest()
            ->take(8)
            ->get();

        // Projects nearing/without recent activity (optional widget)
        $activeProjects = Project::where('status', 'activated')
            ->withCount('collections')
            ->latest()
            ->take(5)
            ->get();

        $totalAgencies = Agency::count();
        $totalCompanies = Company::count();

        return view('dashboard', compact(
            'stats',
            'pipeline',
            'recentCollections',
            'activeProjects',
            'totalAgencies',
            'totalCompanies'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
