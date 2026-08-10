@extends('layouts.app')
@section('title', 'Companies')
@section('content')
    <div class="page-content">
        <div class="container-fluid mt-8">
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Company List</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('company.create') }}" class="btn btn-info">
                                            <i class="fa fa-plus"></i> Company Create
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
                                                <th>Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companies as $company)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $company->name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('company.edit', $company->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('company.destroy', $company->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this company?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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
