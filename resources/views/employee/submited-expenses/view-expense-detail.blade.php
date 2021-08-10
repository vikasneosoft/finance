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
                        <h1>Expense View</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('expenses.get_submited_expenses_by_employee') }}">Approval</a>
                            </li>
                            <li class="breadcrumb-item active">Expense detail</li>
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
                                    <a href="#" class="add-detail-element"><i class="fas fa-plus"
                                            style="font-size: 20px;"></i></a> <a href="#"
                                        class="close-detail-element d-none"><i class="fas fa-minus"
                                            style="font-size: 20px;"></i></a>
                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-4 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
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
                                <div class="col-md-4 table-responsive">
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
                                            <tr>
                                                <th>Scope of work: </th>
                                                <td>{{ $expense['scope_of_work'] }}</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 table-responsive">
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
                                                <th>Why is it required: </th>
                                                <td>{{ $expense['why_required'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>What will change: </th>
                                                <td>{{ $expense['what_will_change'] }}</td>
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
                                <div class="offset-md-1 col-md-12">

                                    Balance
                                    :
                                    {{ $expense['budget_sum']['budget_amount'] - $expense['total_expense']['expensive_amount'] }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="budget-detail-div" class="row">
                        <div class="col-12 table-responsive">
                            <table id="load-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Expense For</th>
                                        <th>Specifications</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Budget AMT</th>
                                        <th>Exp AMT</th>
                                        <th>Balance</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Justification or Detailing</th>
                                        <th>Fileupload</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($expense))
                                        <?php $total = 0; ?>
                                        @foreach ($expense['expense_detail'] as $key => $value)
                                            @php $total+= $value['expensive_amount'] @endphp
                                            <tr class="tr-{{ $value['id'] }}">
                                                <td>{{ $value['expensive_for'] }}</td>
                                                <td>{{ $value['specifications'] }}</td>
                                                <td>{{ $value['expensive_quantity'] }} </td>
                                                <td>{{ IND_money_format($value['expensive_rate']) }} </td>
                                                <td>{{ IND_money_format($expensDetails[$key]['budget_amount']) }}</td>
                                                <td>{{ IND_money_format($value['expensive_amount']) }} </td>
                                                <td>{{ IND_money_format($expensDetails[$key]['balance']) }} </td>
                                                <td>{{ $value['category_name'] }}</td>
                                                <td>{{ $value['subcategory_name'] }}</td>
                                                <td>{{ $value['expensive_explanation'] }}</td>
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

                    <div class="row no-print">
                        <div class="col-12">
                            @if ($rounting->approval_status == 0)

                                <a data-id={{ $expense['id'] }} class="reject-expense btn btn-danger float-right"
                                    href="">Reject</a>
                                <a data-id={{ $expense['id'] }} class="approve-expense btn btn-primary float-right"
                                    href="">Approve</a>
                            @elseif($rounting->approval_status == 1)
                                <a class="btn btn-primary float-right" href="">Approved by you</a>
                            @else
                                <span class="btn btn-danger" href="">Rejected by

                                    @if (auth::user()->id == $rounting->rejectedBy['id'])
                                        You
                                    @else
                                        {{ $rounting->rejectedBy['name'] }}
                                    @endif
                                </span>
                                <span class="float-right">Reason : {{ $rounting->reason }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 float-right">
                            @if ($rounting->approval_status == 0)
                                <textarea id="reason" name="reason" placeholder="Reason fo rejection"
                                    class="form-control "></textarea><span id="error-msg" class="error"></span>
                            @endif
                        </div>
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
