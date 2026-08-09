@extends('layouts.app')
@section('title', 'Permission')
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
                                    <h4>Permission Menu List</h4>
                                    <a href="{{ route('permission.create') }}" class="btn btn-info">
                                        <i class="fa fa-plus"></i> Menu Create
                                    </a>
                                </div>

                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-sm table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Sl</th>
                                            <th>Menu Name</th>
                                            <th>Parent Menu</th>
                                            <th>Sort Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
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
        $(function() {

            $('#table').DataTable({
                processing: true,
                serverSide: true,

                ajax: '{{ route('permission.datatable') }}',
                dom: '<"d-flex justify-content-between align-items-center mb-3"l<"text-center flex-grow-1"B>f>' +
                    'rtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'parent',
                        name: 'parent.name'
                    },

                    {
                        data: 'sort',
                        name: 'sort'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
            $('body').on('click', '.btn-delete', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#34C38F',
                    cancelButtonColor: '#F46A69',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "DELETE",
                            url: "{{ route('permission.destroy', ['permission' => 'REPLACE_WITH_ID_HERE']) }}"
                                .replace('REPLACE_WITH_ID_HERE', id),
                            data: {
                                id: id
                            }
                        }).done(function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        });

                    }
                })

            });
        });
    </script>

@endsection
