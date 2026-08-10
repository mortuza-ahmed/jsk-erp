@extends('layouts.app')
@section('title', 'Final Status Edit')
@section('content')
    <div class="page-content">
        <div class="container-fluid mt-8">
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Final Status Edit</h4>
                                    <a href="{{ route('final-status.index') }}" class="btn btn-info">
                                        <i class="fas fa-arrow-circle-left"></i> Final Status List
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('final-status.update', $finalStatus->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $finalStatus->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-info">Update</button>
                                    <a href="{{ route('final-status.index') }}" class="btn btn-secondary">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
