@extends('layouts.app')
@section('title', 'Role Create')
@section('style')
    <style>
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
                                    <h4>Role Create</h4>
                                </div>
                            </div>
                            <form class="custom-validation" enctype="multipart/form-data" action="{{ route('role.store') }}"
                                method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="mt-3">
                                        <label class="mb-1">Role Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}" maxlength="255"
                                            class="form-control length_count" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <table id="table" class="table table-bordered dt-responsive nowrap mt-3"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <tr>
                                            <td class="text-left">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="check-all-checkbox"
                                                        class="check-all-checkbox">
                                                    <label style="font-size: 18px" for="check-all-checkbox">Check
                                                        All</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td style="font-size: 16px" class="text-left">
                                                    <div class="icheck-success">
                                                        <input type="checkbox" id="for_label_{{ $permission->id }}"
                                                            class="parent-checkbox" name="permission[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="parent-checkbox-label"
                                                            for="for_label_{{ $permission->id }}">
                                                            {{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                                                    </div>
                                                    <ul>
                                                        @foreach ($permission->children as $childrenItem)
                                                            <li style="font-size: 15px;list-style-type: none">

                                                                <div class="icheck-success">
                                                                    <input type="checkbox"
                                                                        id="for_label_{{ $childrenItem->id }}"
                                                                        class="child-checkbox" name="permission[]"
                                                                        value="{{ $childrenItem->id }}">
                                                                    <label class="child-checkbox-label"
                                                                        for="for_label_{{ $childrenItem->id }}">
                                                                        {{ ucwords(str_replace('_', ' ', $childrenItem->name)) }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
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
                $(document).ready(function() {
                    function updateParentCheckboxes() {
                        $('.parent-checkbox').each(function() {
                            var $this = $(this);
                            var $childCheckboxes = $this.closest('td').find(
                                '.child-checkbox, .grandchild-checkbox, .great-grandchild-checkbox');
                            var checkedChildCheckboxes = $childCheckboxes.filter(':checked');

                            if (checkedChildCheckboxes.length > 0) {
                                $this.prop('checked', true);
                            }
                        });
                    }

                    $('.check-all-checkbox').change(function() {
                        var isChecked = $(this).prop('checked');
                        $('.parent-checkbox, .child-checkbox, .grandchild-checkbox, .great-grandchild-checkbox')
                            .prop('checked', isChecked);
                        updateParentCheckboxes();
                    });

                    $('.child-checkbox, .grandchild-checkbox, .great-grandchild-checkbox').change(function() {
                        updateParentCheckboxes();
                    });

                    $('.parent-checkbox').change(function() {
                        $(this).closest('tr').find(
                            '.child-checkbox, .grandchild-checkbox, .great-grandchild-checkbox').prop('checked',
                            this.checked);
                    });

                    $('.child-checkbox').change(function() {
                        $(this).closest('li').find('.grandchild-checkbox, .great-grandchild-checkbox').prop(
                            'checked', this.checked);
                    });

                    updateParentCheckboxes();
                });
            </script>
        @endsection
