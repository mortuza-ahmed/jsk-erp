@extends('layouts.app')
@section('title', 'Projects')
@section('style')
    <style>
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 22px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.25s;
            border-radius: 999px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: #fff;
            transition: 0.25s;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .toggle-switch input:checked+.toggle-slider {
            background-color: #34c38f;
        }

        .toggle-switch input:checked+.toggle-slider:before {
            transform: translateX(22px);
        }

        .toggle-switch input:disabled+.toggle-slider {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid mt-8">
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Project List</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('projects.create') }}" class="btn btn-info">
                                            <i class="fa fa-plus"></i> Project Create
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-sm table-striped"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-success">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Project Name</th>
                                                <th>Country</th>
                                                <th>Company</th>
                                                <th>Waqala/Visa</th>
                                                <th>Profession</th>
                                                <th>Ref No.</th>
                                                <th>Initiate</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $project)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $project->project_name }}</td>
                                                    <td>{{ $project->country }}</td>
                                                    <td>{{ $project->company_name }}</td>
                                                    <td>{{ $project->waqala_visa_number }}</td>
                                                    <td>{{ $project->profession }}</td>
                                                    <td>{{ $project->ref_no ?? '-' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($project->initiate_date)->format('d M Y') }}
                                                    </td>
                                                    <td>
                                                        <label class="toggle-switch"
                                                            title="{{ $project->status == 'activated' ? 'Activated' : 'Closed' }}">
                                                            <input type="checkbox" class="status-toggle"
                                                                data-id="{{ $project->id }}"
                                                                {{ $project->status == 'activated' ? 'checked' : '' }} />
                                                            <span class="toggle-slider"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('projects.collectionView', $project->id) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('projects.edit', $project->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('change', '.status-toggle', function() {
                const $checkbox = $(this);
                const id = $checkbox.data('id');

                $.ajax({
                    url: '{{ url('projects') }}/' + id + '/toggle-status',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        toastr.success(res.message);
                    },
                    error: function() {
                        toastr.error('Failed to update status.');
                        // revert checkbox on failure
                        $checkbox.prop('checked', !$checkbox.prop('checked'));
                    }
                });
            });
        });
    </script>
@endsection
