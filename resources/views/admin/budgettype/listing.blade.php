@extends('admin.layout')
@section('title')
    Manage Budget Types
@endsection

@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Budget Types</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item active">Budget Types</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('budget-type.create') }}" class="btn btn-block btn-primary">Add</a>
                                </h3>
                            </div>

                            <div class="card-body">
                                @include('flash::message')
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered table-striped dataTable dtr-inline yajra-datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">Sr No.</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

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
        </section>
    </div>

@endsection
@section('admin-js')
    <script src="{{ asset('public/admin/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('budget-type.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            render: function(data, type, row) {
                                console.log(data)
                                return '#' + data
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            });

            /** Delete **/
            $(document).on("click", ".delete", function() {
                let id = $(this).attr('data-id');

                bootbox.confirm("Are you sure you want to delete?", function(result) {
                    if (result) {
                        $.ajax({
                            url: "{{ route('budget-type.destroy', 'id') }}",
                            type: "DELETE",
                            data: {
                                id: id,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#loadingImage").css({
                                    "display": "block"
                                });
                            },
                            success: function(response) {

                                location.reload();
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
