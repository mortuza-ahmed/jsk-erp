@extends('layouts.app')
@section('title', 'Users Edit')
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
                                    <h4>User Edit</h4>
                                </div>
                            </div>
                            <form class="custom-validation" enctype="multipart/form-data"
                                action="{{ route('user.update', ['user' => $user->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- <div class="">
                                        <label class="mb-1">Role <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="form-control select2">
                                            <option value="">--Select Role--</option>
                                            <option value="admin"
                                                {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="manager"
                                                {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="">
                                        <label class="mb-1">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            maxlength="255" class="form-control length_count" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1">Email <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('email', $user->email) }}"
                                            class="form-control length_count" maxlength="100" name="email"
                                            id="email" />
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-1">Mobile No <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('mobile_no', $user->mobile_no) }}"
                                            class="form-control length_count" maxlength="25" name="mobile_no"
                                            id="mobile_no" />
                                        @error('mobile_no')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label">Password (Equal To)</label>
                                        <div>
                                            <input type="password" id="pass2" class="form-control" name="password"
                                                placeholder="Password" value="{{ old('password') }}" />
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Re-Type Password"
                                                value="{{ old('password_confirmation') }}" />
                                            @error('password_confirmation')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1">Status <span class="text-danger">*</span></label>
                                        <br />
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" id="switch3" name="status" switch="bool" value="1"
                                            {{ old('status', $user->status) == 1 ? 'checked' : '' }} />
                                        <label for="switch3" data-on-label="Active" data-off-label="Inactive"
                                            class="switch-label"></label>
                                        @error('status')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Submit
                                            </button>
                                            <a href="{{ route('user.index') }}" type="reset"
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
