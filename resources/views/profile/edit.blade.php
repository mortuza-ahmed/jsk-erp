@extends('layouts.app')
@section('title', 'Profile Update')
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
                    <div class="col-12 col-sm-12 col-md-8 col-lg-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Profile Update</h4>
                                </div>
                            </div>
                            <form class="custom-validation" enctype="multipart/form-data"
                                action="{{ route('profile.update') }}" method="post">
                                @csrf
                                <div class="card-body">

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
                                        <label class="mb-1">Profile Photo <span class="text-danger">*</span></label>
                                        <input type="file" value="{{ old('profile_photo') }}"
                                            class="form-control length_count" name="profile_photo" id="profile_photo" />
                                        @if (file_exists($user->profile_photo))
                                            <img src="{{ asset($user->profile_photo) }}" alt="Profile Photo"
                                                class="img-fluid" width="100">
                                        @endif
                                        @error('profile_photo')
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
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Submit
                                            </button>
                                            <a href="{{ route('profile.update') }}" type="reset"
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
