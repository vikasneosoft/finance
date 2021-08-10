@extends('employee.layout')
@section('title')
Expense against budget
@endsection

@section('employee-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Create expense against budget</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item active">Budgets</li>
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
                                                class="table x-table-responsive table-sm table-bordered table-striped yajra-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th>Cost Center</th>
                                                        <th>Proj Code</th>
                                                        <th class="right-side-text">Budget#</th>
                                                       {{--  <th>Incharge</th> --}}
                                                        {{-- <th>Creator</th> --}}
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Submission</th>

                                                        <th>Actions</th>
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
@section('employee-js')

    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('budget.get_budgets') }}",
                    columns: [{
                            data: 'financialYear',
                            name: 'financialYear'
                        },
                        {
                            data: 'budget_type',
                            name: 'budget_type'
                        },
                        {
                            data: 'costCenter',
                            name: 'costCenter'
                        },
                        {
                            data: 'projectCode',
                            name: 'projectCode'
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },
                        /*{
                            data: 'project_in_charge',
                            name: 'project_in_charge'
                        },
                         {
                            data: 'createdBy',
                            name: 'createdBy'
                        }, */
                        {
                            data: 'budgetSum',
                            name: 'budgetSum'
                        },
                        {
                            data: 'expensesSum',
                            name: 'expensesSum'
                        },
                        /*{
                                data: 'mobile_number',
                                name: 'mobile_number'
                            },*/
                        /* {
                            data: 'balance',
                            name: 'balance'
                        }, */
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ],
                    columnDefs: [ {
                    targets: [4,5,6],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                });
            });
        });
    </script>
@endsection
