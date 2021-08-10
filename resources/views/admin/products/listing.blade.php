@extends('admin.layout')
@section('title')
    Manage Products
@endsection

@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Products</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                    <a href="{{ route('products.create') }}" class="btn btn-block btn-primary">Add</a>
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
                                            <table id="example1"
                                                class="table table-bordered table-striped dataTable yajra-datatable">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Sr No.</th>
                                                        <th>Name</th>
                                                        <th>Image</th>
                                                        <th>Category</th>

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
    @include('admin.products.popupcategory')
@endsection
@section('admin-js')
    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('products.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'category',
                            name: 'category'
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

            $(document).on("click", ".view-category", function() {
                var catId = $(this).attr("cat-id");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('category.detail') }}",
                    type: "GET",
                    data: {
                        id: catId,
                    },
                    dataType: "JSON",
                    success: function(response) {


                        $('#name').text(response.name);
                        $('#description').text(response.description);
                        $('#category-modal').modal('show');

                    }
                });
            });

            /** Delete Product **/
            $(document).on("click", ".delete", function() {
                let id = $(this).attr('data-id');

                bootbox.confirm("Are you sure you want to delete?", function(result) {
                    if (result) {
                        $.ajax({
                            url: "{{ route('products.destroy', 'id') }}",
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
                            success: function(data) {
                                location.reload();
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
