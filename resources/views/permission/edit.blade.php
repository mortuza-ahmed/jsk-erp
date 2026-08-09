@extends('layouts.app')
@section('title', 'Menu Edit')
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
                                    <h4>Menu Edit</h4>
                                </div>
                            </div>
                            <form class="custom-validation" enctype="multipart/form-data"
                                action="{{ route('permission.update', ['permission' => $permission->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="mt-3">
                                        <label class="mb-1">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                                            maxlength="255" class="form-control length_count" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label class="mb-1">Parent Menu</label>
                                        <select name="parent_id" class="form-control select2">
                                            <option value="">-- Select Parent --</option>
                                            @foreach ($permissions as $item)
                                                @if ($item->id != $permission->id)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('parent_id', $permission->parent_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-1">Sort Order</label>
                                        <input type="number" name="sort" value="{{ old('sort', $permission->sort) }}"
                                            class="form-control" />
                                    </div>

                                    <div class="mt-3">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Submit
                                            </button>
                                            <a href="{{ route('permission.index') }}" type="reset"
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
