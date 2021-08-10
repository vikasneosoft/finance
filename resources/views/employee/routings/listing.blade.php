@extends('employee.layout')
@section('title')
    Approve Expenses
@endsection

@section('employee-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">


                </div>
                <div class="row">

                    <div class="col-sm-8">

                        <div class="col-sm-8">
                            <h3>Approval Levels</h3>
                        </div>

                    </div>


                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>

                            <li class="breadcrumb-item active">Approval Levels</li>
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
                                                class="table table-bordered table-sm table-striped yajra-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Level</th>
                                                        <th>Employee</th>
                                                        <th class="right-side-text">Max Approve Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                        @foreach ($routings as $value)
                                                            <tr>
                                                                <td>{{ $value['level'] }}</td>
                                                                <td>{{ $value['manager']['name'] }}</td>
                                                                <td>{{  IND_money_format($value['maximum_amount']) }}</td>

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
        </section>
    </div>
@endsection
@section('employee-js')


    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    columnDefs: [ {
                    targets: [2],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                });
            });
        });
    </script>
@endsection
