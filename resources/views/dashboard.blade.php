@extends('layouts.app')
@section('title', 'Dashboard')
@section('style')
    <style>
        :root {
            --brand-start: #556ee6;
            --brand-end: #34c38f;
        }

        .mini-stat.card-gradient {
            background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%);
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .mini-stat.card-gradient .mini-stat-icon i {
            opacity: 0.25;
        }

        .mini-stat.card-gradient .badge.bg-light {
            color: var(--brand-start) !important;
        }

        .pipeline-bar {
            height: 10px;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            background: #eef0f4;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Welcome to JSK ERP</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="row">
                @foreach ($stats as $stat)
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat card-gradient position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <div class="text-white">
                                        <h5 class="text-uppercase font-size-16 text-white-50">{{ $stat['label'] }}</h5>
                                        <h3 class="mb-3 text-white">{{ $stat['value'] }}</h3>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi {{ $stat['icon'] }} display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <!-- Pipeline breakdown -->
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Candidate Pipeline</h5>
                            @php $total = array_sum($pipeline) ?: 1; @endphp
                            <div class="pipeline-bar mb-3">
                                @foreach ($pipeline as $stage => $count)
                                    <div style="width: {{ $count / $total * 100 }}%; background: hsl({{ $loop->index * 60 }}, 65%, 55%);"
                                        title="{{ $stage }}: {{ $count }}"></div>
                                @endforeach
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        @foreach ($pipeline as $stage => $count)
                                            <tr>
                                                <td>
                                                    <span class="badge rounded-pill"
                                                        style="background: hsl({{ $loop->index * 60 }}, 65%, 55%); width:10px; height:10px; display:inline-block;">&nbsp;</span>
                                                    {{ $stage }}
                                                </td>
                                                <td class="text-end fw-bold">{{ $count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick counts -->
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Overview</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Agencies
                                    <span class="badge bg-primary rounded-pill">{{ $totalAgencies }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Companies
                                    <span class="badge bg-success rounded-pill">{{ $totalCompanies }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Active projects -->
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Active Projects</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Country</th>
                                            <th class="text-end">Candidates</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($activeProjects as $project)
                                            <tr>
                                                <td>{{ $project->project_name }}</td>
                                                <td>{{ $project->country }}</td>
                                                <td class="text-end">{{ $project->collections_count }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No active projects</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent candidates -->
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Recent Candidates</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Passport No.</th>
                                            <th>Project</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentCollections as $c)
                                            <tr>
                                                <td>{{ $c->name }}</td>
                                                <td>{{ $c->pp_no ?? '-' }}</td>
                                                <td>{{ $c->project->project_name ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $c->status ?? 'In Progress' }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No candidates yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
