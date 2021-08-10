@extends('admin.layout')
@section('title')
    Budget Detail
@endsection
@section('admin-css')
    <link href="{{ asset('public/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('admin-content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Budget Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('budgets.index') }}">Budgets</a></li>
                            <li class="breadcrumb-item active">Budget Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">

                            <div class="row">

                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>User</strong>: {{ $user->name }}<br>
                                        <strong>Company</strong>: {{ $user->company['name'] }}<br>
                                        <strong>Location</strong>: {{ $user->location['name'] }}<br>
                                        <strong>Division</strong>: {{ $user->division['name'] }}<br>
                                        <strong>Department</strong>: {{ $user->department['name'] }}<br>
                                        <strong>Section</strong>: {{ $user->section['name'] }}<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>Financial Year</strong>:{{ $budget->financial_year }}<br>
                                        <strong>Cost Cnter</strong>:--<br>
                                        <strong>Project Codes</strong>:--<br>
                                        <strong>Project Inchage</strong>:--<br>
                                        <strong>Budget ID</strong>:{{ $budget->id }}<br>
                                    </address>
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Budget ID</th>
                                                <th>Budget For</th>
                                                <th>Specifications</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Budget AMT</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Justification or Detailing</th>
                                                <th>Fileupload</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $budget->id }}</td>
                                                <td>{{ $budget->budget_for }}</td>
                                                <td>{{ $budget->specifications }}</td>
                                                <td>{{ $budget->budget_quantity }}</td>
                                                <td>{{ IND_money_format($budget->budget_rate) }}</td>
                                                <td>{{ IND_money_format($budget->budget_amount) }}</td>
                                                <td>{{ $budget->budgetCategory['name'] }}</td>
                                                <td>{{ $budget->budgetSubcategory['name'] }}</td>
                                                <td>{{ $budget->budget_explanation }}</td>
                                                <td><a target="_blank"
                                                        href="{{ URL::asset('/public/budget_images/' . $budget->image) }}">View
                                                        File</a></td>


                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">


                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->

                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('admin-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>

@endsection
