@extends('layouts.app')
@section('title', 'User Assign Role')
@section('style')
    <style>
        .switch-label {
            width: 72px !important;
        }

        input[switch]:checked+label:after {
            left: 50px !important;
            background-color: #eff2f7;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid mt-8">
            <!-- Start Page-content-Wrapper -->
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>User Assign Role</h4>
                                </div>
                            </div>
                            <form class="custom-validation" enctype="multipart/form-data"
                                action="{{ route('user_assign_role.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="">
                                        <label class="mb-1">Role <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="form-control select2">
                                            <option value="">--Select Role--</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1">User <span class="text-danger">*</span></label>
                                        <select name="user" id="user" class="form-control select2">
                                            <option value="">--Select User--</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('user') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Submit
                                            </button>
                                            <a href="{{ route('role.index') }}" type="reset"
                                                class="btn btn-secondary waves-effect">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- End Page-content -->
                </div>
            </div>
        @endsection

        @section('script')
            <script>
                $(function() {});
            </script>

        @endsection
