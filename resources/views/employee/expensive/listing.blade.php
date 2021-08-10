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

                        <a href="{{ route('budget.get_budgets') }}" title="Add Budget"><i class="fas fa-backward"
                                style="font-size: 20px;"></i></a>

                    </div>


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('budget.get_budgets') }}"><i
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
                                                class="table x-table-responsive table-sm table-bordered table-striped yajra-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Exp#</th>
                                                        <th>Type</th>
                                                        <th>CostCenter</th>
                                                        <th>Proj.Code</th>
                                                        <th>Incharge</th>
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                        <th>Creator</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @if (!empty($expenses))
                                                        @foreach ($expenses as $value)
                                                            <tr>
                                                                <td>{{ $value['id'] }}</td>
                                                                <td>{{ $value['budget_type']['name'] }}</td>
                                                                <td>{{ $value['cost_center']['name'] }}</td>
                                                                <td>{{ $value['project_code']['code'] }}</td>
                                                                <td>{{ $value['project_in_charge'] }}</td>
                                                                <td class="right-side-text">
                                                                    @if (isset($value['budget_sum']['budget_amount']))
                                                                        {{ IND_money_format($value['budget_sum']['budget_amount']) }}
                                                                    @endif
                                                                </td>
                                                                <td class="right-side-text">
                                                                    @if (isset($value['expenses_sum']['expensive_amount']))
                                                                        {{ IND_money_format($value['expenses_sum']['expensive_amount']) }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $value['employee']['name'] }}
                                                                <td>{{ Carbon\Carbon::parse($value['created_at'])->format('d-m-Y') }}
                                                                </td>
                                                                <td>

                                                                    <a
                                                                        href="{{ route('expenses.view_to_edit_expenses', ['id' => $value['id']]) }}"><i
                                                                            class="far @if ($value['submited']==0) fa-edit @else fa-eye @endif" style="font-size: 20px;"></i></a>

                                                                    @if (in_array($value['employee_id'], findUserOfSameLevel()))

                                                                        @if ($value['submited'] == 0)
                                                                            <a href="#" data-id={{ $value['id'] }}
                                                                                class="delete-expenses"><i
                                                                                    class="fas fa-trash-alt"
                                                                                    style="font-size: 20px;"></i></a>
                                                                        @endif
                                                                        @if (isset($value['expenses_sum']['expensive_amount']))
                                                                            @if ($value['submited'] == 0)
                                                                                <a href="#" title="Submit for approval" data-budgetId={{$value['budget_id']}} data-expense={{$expenseAmount}} data-budget={{$value['budget_sum']['budget_amount']}}
                                                                                    data-expense-amount={{ $value['expenses_sum']['expensive_amount'] }}
                                                                                    data-id={{ $value['id'] }}
                                                                                    class="submit-for-approval"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                                                </a>
                                                                            @else
                                                                                @if ($value['is_approved'] == 0)
                                                                                    Submitted for approval
                                                                                @elseif($value['is_approved'] == 1)
                                                                                    Approved
                                                                                @else
                                                                                    Rejected
                                                                                @endif

                                                                            @endif
                                                                        @endif

                                                                    @endif


                                                                </td>
                                                        @endforeach
                                                    @endif
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
            /** Delete **/

            $(document).on("click", ".delete-expenses", function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                bootbox.confirm("Are you sure you want to delete?", function(result) {
                    if (result) {
                        $.ajax({
                            url: "{{ route('expensive.delete') }}",
                            type: "post",
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
                                location.reload()
                            },
                        });
                    }
                });
            })

            $(document).on("click", ".submit-for-approval", function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let budgetId = $(this).attr('data-budgetId');
                let expenseAmount = $(this).attr('data-expense-amount');
                let submittedAExpenseAmount = parseFloat($(this).attr('data-expense'));
                let budgetAmount = parseFloat($(this).attr('data-budget'));
                if(submittedAExpenseAmount>budgetAmount){
                    bootbox.confirm({
                            message: "Budget is less, expense is more, do you still submit the expense ?",
                            buttons: {
                                confirm: {
                                    label: 'Yes',
                                    className: 'btn-success'
                                },
                                cancel: {
                                    label: 'No',
                                    className: 'btn-danger'
                                }
                            },
                            callback: function (result) {
                                if (result) {
                                    $.ajax({
                                    url: "{{ route('expenses.submit_expenses') }}",
                                    type: "POST",
                                    data: {
                                        id: id,
                                        budgetId:budgetId,
                                        expense_amount: expenseAmount
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
                            }
                        });
                }else{
                    $.ajax({
                            url: "{{ route('expenses.submit_expenses') }}",
                            type: "POST",
                            data: {
                                id: id,
                                budgetId:budgetId,
                                expense_amount: expenseAmount
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


            })
        });
    </script>
@endsection
