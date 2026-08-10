
@extends('layouts.app')
@section('title', 'Agencies')
@section('style')
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
                                    <h4>Agency List</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('agency.create') }}" class="btn btn-info">
                                            <i class="fa fa-plus"></i> Agency Create
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
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($agencies as $agency)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $agency->name }}</td>
                                                    <td>{{ $agency->email ?? '-' }}</td>
                                                    <td>{{ $agency->phone ?? '-' }}</td>
                                                    <td>{{ $agency->address ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('agency.edit', $agency->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('agency.destroy', $agency->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this agency?');">
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

@section('script')
@endsection
