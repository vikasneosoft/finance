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
                            <h3>PRs Pending for Approvals</h3>
                        </div>

                    </div>


                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>

                            <li class="breadcrumb-item active">Approvals</li>
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
                                                        <th class="right-side-text">BudgetId</th>
                                                        <th class="right-side-text">ExpenseId</th>
                                                        {{-- <th>Type</th> --}}
                                                        <th>Creator</th>

                                                        {{-- <th>Expense#</th> --}}

                                                        {{-- <th>Budget Amount</th> --}}
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                        <th class="right-side-text">Balance</th>
                                                        <th>Status</th>
                                                        <th>View</th>
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
                    ajax: "{{ route('expenses.get_submited_expenses_by_employee') }}",
                    columns: [{
                            data: 'financialYear',
                            name: 'financialYear'
                        },
                        {
                            data: 'budget_id',
                            name: 'budget_id'
                        },
                        {
                            data: 'expenseId',
                            name: 'expenseId'
                        },
                        /* {
                            data: 'budgetType',
                            name: 'budgetType'
                        }, */
                        {
                            data: 'employee',
                            name: 'employee'
                        },

                        /*  {
                             data: 'costCenter',
                             name: 'costCenter'
                         }, */
                        /* {
                            data: 'expensive_code',
                            name: 'expensive_code'
                        }, */

                        {
                            data: 'budgetAmt',
                            name: 'budgetAmt'
                        },
                        {
                            data: 'expense_amount',
                            name: 'expense_amount'
                        },
                        {
                            data: 'balance',
                            name: 'balance'
                        },

                        {
                            data: 'status',
                            name: 'status'
                        },
                        /* {
                            data: 'balance',
                            name: 'balance'
                        }, */
                        /*{
                                data: 'mobile_number',
                                name: 'mobile_number'
                            },
                            {
                                data: 'contact_person',
                                name: 'contact_person'
                            }, */

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ],
                    columnDefs: [ {
                    targets: [1,2,4,5,6],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                });
            });
        });
    </script>
@endsection
