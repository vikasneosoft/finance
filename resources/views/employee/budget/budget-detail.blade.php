@extends('employee.layout')
@section('title')
    Budget Detail
@endsection
@section('employee-css')
@endsection
@section('employee-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Budget Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('budget.get_budgets') }}">Expense against
                                    budget</a>
                            </li>
                            <li class="breadcrumb-item active">Budget detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">

                                <h3 class="card-title">Header Information</h3>
                                <h3 class="card-title float-right">

                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-4 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Financial year: </th>
                                                <td>{{ $budget->financialYear['year'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Expense type: </th>
                                                <td>{{ $budget->budgetType['name'] }}</td>
                                            </tr>

                                            <tr>
                                                <th> Cost Cnter: </th>
                                                <td>{{ $budget->costCenter['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Vendor: </th>
                                                <td>{{ $budget->vendor }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Project Codes: </th>
                                                <td>{{ $budget->projectCode['code'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Project ref no: </th>
                                                <td>{{ $budget->budget_proj_ref_no }}</td>
                                            </tr>

                                            <tr>
                                                <th> Project Incharge: </th>
                                                <td>{{ $budget->project_in_charge }}</td>
                                            </tr>
                                            <tr>
                                                <th>Vendor Contacts: </th>
                                                <td>{{ $budget->vendor_contacts }}</td>
                                            </tr>




                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Start date: </th>
                                                <td>{{ Carbon\Carbon::parse($budget->budget_from_date)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> End date: </th>
                                                <td>{{ Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Budget code: </th>
                                                <td>{{ $budget->budget_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Create expense: </th>
                                                <td><a class="btn btn-primary btn-sm" title="Create Expenses"
                                                        href="{{ route('expensive.view_add_expensive', $budget->id) }}">Click</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="offset-md-1 col-md-12">


                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="budget-detail-div" class="row">
                        <div class="col-12 table-responsive">
                            <table id="load-table" class="table table-striped">
                                <thead>
                                    <tr>
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
                                    @if (isset($budget))
                                        <?php $total = 0; ?>
                                        @foreach ($budget->budgetDetail as $value)
                                            @php $total+= $value['expensive_amount'] @endphp
                                            <tr class="tr-{{ $value['id'] }}">
                                                <td>{{ $value['budget_for'] }}</td>
                                                <td>{{ $value['specifications'] }}</td>
                                                <td>{{ $value['budget_quantity'] }} </td>
                                                <td>{{ IND_money_format($value['budget_rate']) }} </td>
                                                <td>{{ IND_money_format($value['budget_amount']) }} </td>
                                                <td>{{ $value['category_name'] }}</td>
                                                <td>{{ $value['subcategory_name'] }}</td>
                                                <td>{{ $value['budget_explanation'] }}</td>
                                                <td><a target="_blank"
                                                        href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                                                        File</a></td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div id="form-elements" class="xx-row">

                    </div>



        </section>

    </div>

    <input type="hidden" id="approve-expense-route" value={{ route('expenses.approve_expense') }} />
    <input type="hidden" id="reject-expense-route" value={{ route('expenses.reject_expensees') }} />
@endsection
@section('employee-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('public/js/approve-disapprove-expensive.js') }}"></script>

@endsection
