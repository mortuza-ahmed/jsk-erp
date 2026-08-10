<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class CollectionExport implements FromView, ShouldAutoSize
{
    protected $project;
    protected $collections;

    public function __construct(Project $project, $collections)
    {
        $this->project = $project;
        $this->collections = $collections;
    }

    public function view(): View
    {
        return view('exports.collection', [
            'project'     => $this->project,
            'collections' => $this->collections,
        ]);
    }
}
