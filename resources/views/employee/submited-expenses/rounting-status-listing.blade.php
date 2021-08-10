@extends('employee.layout')
@section('title')
    Manage Expenses
@endsection

@section('employee-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">


                </div>
                <div class="row">

                    <div class="col-sm-6">

                        <a href="{{ route('budget.index') }}" title="Add Budget"><i class="fas fa-backward"
                                style="font-size: 20px;"></i></a>

                    </div>


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('budget.index') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Budgets</a></li>
                            <li class="breadcrumb-item active">Expenses</li>
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
                                                class="table table-responsive table-bordered table-striped yajra-datatable">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Sr No</th>
                                                        <th>Fincial Year</th>

                                                        <th>Budget Type</th>
                                                        <th>Cost Center</th>
                                                        <th>Budget Code</th>
                                                        <th>Project code</th>
                                                        <th>Expense Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($expenses as $key => $value)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $value['financial_year']['year'] }}</td>

                                                            <td>{{ $value['budget_type']['name'] }}</td>
                                                            <td>{{ $value['cost_center']['name'] }}</td>
                                                            <td>{{ $value['expensive_code'] }}</td>
                                                            <td>{{ $value['project_code']['code'] }}</td>
                                                            <td>{{ $value['expense_amount'] }}</td>
                                                            <td>
                                                                @if ($value['approval_status'] == 0)
                                                                    Pending
                                                                @elseif($value['approval_status']==1)
                                                                    Approved
                                                                @else
                                                                    Rejected
                                                                @endif

                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="{{ route('expenses.expenses_detail_by_employee', ['id' => $value['id']]) }}"><i
                                                                        class="far fa-eye" style="font-size: 20px;"></i></a>


                                                            </td>
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

    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.yajra-datatable').DataTable();
        });
    </script>
@endsection
