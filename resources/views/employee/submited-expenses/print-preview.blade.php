@extends('employee.layout')
@section('title')
    Approve Expenses
@endsection
@section('employee-css')
@endsection
@section('employee-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Expenses view</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('expenses.all_expenses') }}">All Expenses</a>
                            </li>
                            <li class="breadcrumb-item active">Print Preview</li>
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
                                @include('flash::message')
                                <h3 class="card-title">Header Information</h3>

                            </div>
                            <div class="row">
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Expense Document Number: </th>
                                                <td>{{ $expense['id'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Financial year: </th>
                                                <td>{{ $expense['financial_year']['year'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Expense type: </th>
                                                <td>{{ $expense['budget_type']['name'] }}</td>
                                            </tr>

                                            <tr>
                                                <th> Cost Cnter: </th>
                                                <td>{{ $expense['cost_center']['name'] }}</td>
                                            </tr>

                                            <tr>
                                                <th>Budget code: </th>
                                                <td>{{ $expense['expensive_code'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Services are required at: </th>
                                                <td>{{ $expense['location_id'] }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Project Codes: </th>
                                                <td>{{ $expense['project_code']['code'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Project ref no: </th>
                                                <td>{{ $expense['proj_ref_no'] }}</td>
                                            </tr>

                                            <tr>
                                                <th> Project Incharge: </th>
                                                <td>{{ $expense['project_in_charge'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Start date: </th>
                                                <td>{{ Carbon\Carbon::parse($expense['from_date'])->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> End date: </th>
                                                <td>{{ Carbon\Carbon::parse($expense['to_date'])->format('d-m-Y') }}</td>
                                            </tr>




                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Warranty guarantee details: </th>
                                                <td>{{ $expense['warranty_guarantee_details'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>What is required: </th>
                                                <td>{{ $expense['what_is_required'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Scope of work: </th>
                                                <td>{{ $expense['scope_of_work'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Why is it required: </th>
                                                <td>{{ $expense['why_required'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Vendor: </th>
                                                <td>{{ $expense['vendor'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Vendor Contacts: </th>
                                                <td>{{ $expense['vendor_contacts'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Reason for selecting vendor: </th>
                                                <td>{{ $expense['reason_for_selecting_vendor'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>What will change: </th>
                                                <td>{{ $expense['what_will_change'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment terms: </th>
                                                <td>{{ $expense['payment_terms'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Assumptions or inclusions: </th>
                                                <td>{{ $expense['assumptions_or_inclusions'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Exceptions or exclusions: </th>
                                                <td>{{ $expense['exceptions_or_exclusions'] }}</td>
                                            </tr>

                                        </tbody>
                                    </table>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="budget-detail-div" class="row">
                        <h2>Budget Detail</h2>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Bud For</th>
                                        <th>Bud Qty</th>
                                        <th>Rate</th>
                                        <th>Bud AMT</th>
                                        <th>Exp Qty</th>
                                        <th>Exp AMT</th>
                                        <th>Balance</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budget->budgetDetail as $key => $value)
                                        <tr class="tr-{{ $value['id'] }}">
                                            <td>{{ $value['budget_for'] }}</td>
                                            <td>{{ $value['budget_quantity'] }} </td>
                                            <td>{{ IND_money_format($value['budget_rate']) }} </td>
                                            <td>{{ IND_money_format($value['budget_amount']) }} </td>
                                            <td>

                                                @if (isset($expenseDetail[$key]['expense_quantity']))
                                                    {{ $expenseDetail[$key]['expense_quantity'] }}@else -- @endif
                                            </td>
                                            <td>

                                                @if (isset($expenseDetail[$key]['expense_amount']))
                                                    {{ IND_money_format($expenseDetail[$key]['expense_amount']) }}@else --
                                                @endif
                                            </td>
                                            <td>

                                                @if (isset($expenseDetail[$key]['balance']))
                                                    {{ IND_money_format($expenseDetail[$key]['balance']) }}@else --
                                                @endif
                                            </td>
                                            <td>{{ $value['category_name'] }}</td>
                                            <td>{{ $value['subcategory_name'] }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div id="expense-detail-div" class="row">
                        <h2>Expense Detail</h2>
                        <div class="col-12 table-responsive">
                            <table id="load-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Expense For</th>
                                        <th>Specifications</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Expense AMT</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Justification or Detailing</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($expense))
                                        <?php $total = 0; ?>
                                        @foreach ($expense['expense_detail'] as $value)
                                            @php $total+= $value['expensive_amount'] @endphp
                                            <tr class="tr-{{ $value['id'] }}">
                                                <td>{{ $value['expensive_for'] }}</td>
                                                <td>{{ $value['specifications'] }}</td>
                                                <td>{{ $value['expensive_quantity'] }} </td>
                                                <td>{{ IND_money_format($value['expensive_rate']) }} </td>
                                                <td>{{ IND_money_format($value['expensive_amount']) }} </td>
                                                <td>{{ $value['category_name'] }}</td>
                                                <td>{{ $value['subcategory_name'] }}</td>
                                                <td>{{ $value['expensive_explanation'] }}</td>


                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>


                    <div class="row no-print">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            <tbody>
                            @foreach ($expense['pending_level'] as $key => $value)
                            <tr>
                                <td>{{ $value['level'] }} </td>
                                <td>
                                    @if($value['approval_status']==0)
                                    Pending from   -- {{ $value['name'] }}
                                    @elseif ($value['approval_status']==1)
                                        Approved by {{ $value['name'] }}
                                    @else
                                     Rejected by {{ $value['name'] }}
                                    @endif
                                     </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <table>
                        </div>
                    </div>
                </div>
        </section>

    </div>


@endsection
@section('employee-js')

@endsection
