@extends('employee.layout')
@section('title')
Pending Expense
@endsection
@section('employee-css')
@endsection
@section('employee-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pending Expense</h1>
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
                            <div class="thead-color card-header">

                                <h3 class="card-title">Header Information</h3>
                                {{-- <h3 class="card-title float-right">

                                    Balance
                                    :


                                    {{ $expense['budget_sum']['budget_amount'] - $expense['total_expense']['expensive_amount'] }}
                                </h3> --}}
                            </div>


                        </div>
                    </div>



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
                    <div class="col-3 table-responsive">
                        <table id="load-table" class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th class="right-side-text">Budget</th>
                                    <th class="right-side-text">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense['expense_detail'] as $key=>$value)
                                @if($key==0)
                                <tr>
                                    <td class="right-side-text">{{ IND_money_format($value['budget_amt']) }} </td>

                                        <td class="right-side-text">{{ IND_money_format($value['expense_balance']) }} </td>
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="load-table" class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th>Expense For</th>
                                    {{-- <th>Specifications</th> --}}
                                    <th class="right-side-text">Quantity</th>
                                    <th class="right-side-text">Rate</th>
                                    <th class="right-side-text">Submission</th>
                                    <th class="right-side-text">Bud Amt</th>
                                    <th class="right-side-text">Balance</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    {{-- <th>Justification or Detailing</th> --}}
                                     <th>Detail</th>
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
                                           {{--  <td>{{ $value['specifications'] }}</td> --}}
                                            <td class="right-side-text">{{ $value['expensive_quantity'] }} </td>
                                            <td class="right-side-text">{{ IND_money_format($value['expensive_rate']) }} </td>
                                            <td class="right-side-text">{{ IND_money_format($value['expensive_amount']) }} </td>
                                            {{-- <td class="right-side-text">{{ IND_money_format($value['budget_amt']) }}</td> --}}
                                            <td class="right-side-text">{{ IND_money_format($value['budget_amount']) }}</td>
                                            {{-- <td class="right-side-text">{{ IND_money_format($value['expense_balance']) }} </td> --}}
                                            <td class="right-side-text">{{ IND_money_format($value['budget_amount']-$value['expensive_amount']) }} </td>
                                            <td>{{ $value['category_name'] }}</td>
                                            <td>{{ $value['subcategory_name'] }}</td>
                                            {{-- <td>{{ $value['expensive_explanation'] }}</td> --}}
                                            <td><a id="more-detail" data-explanation="{{$value['expensive_explanation']}}" data-specification="{{$value['specifications']}}" href="#">Click </a></td>
                                            <td><a target="_blank"
                                                    href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                                                    File</a></td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        @if ($rounting->approval_status == 0)
                            <textarea id="reason" name="reason" placeholder="Reason fo rejection"
                                class="form-control "></textarea><span id="error-msg" class="error" cols="80"></span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($rounting->approval_status == 0)
                            <a data-budget="{{ $expense['budget_id'] }}" data-id="{{ $expense['id'] }}" class="reject-expense btn btn-danger float-right"
                                href="">Reject</a>
                            <a data-id={{ $expense['id'] }} class="approve-expense btn btn-primary float-right"
                                href="">Approve</a>
                        @elseif($rounting->approval_status == 1)
                            <span class="btn btn-primary float-right">Approved</span>
                        @else
                            <span class="btn btn-danger">Rejected by

                                @if (auth::user()->id == $rounting->rejectedBy['id'])
                                    Me
                                @else
                                    {{ $rounting->rejectedBy['name'] }}
                                @endif
                            </span>
                            <span class="float-right">Reason : {{ $rounting->reason }}</span>
                        @endif
                    </div>
                </div>
        </section>

    </div>

    <input type="hidden" id="approve-expense-route" value={{ route('expenses.approve_expense') }} />
    <input type="hidden" id="reject-expense-route" value={{ route('expenses.reject_expensees') }} />
    @include('employee.submited-expenses.expense-child-detail')
    @endsection
@section('employee-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('public/js/approve-disapprove-expensive.js') }}"></script>
    <script>
        $(document).ready(function () {

            $(document).on( "click", "#more-detail", function (e) {
                e.preventDefault();
                let explanation = $(this).attr('data-explanation');
                let specification = $(this).attr('data-specification');

                $(".modal-body #explanation").html(explanation);
                $(".modal-body #specification").html(specification);
                $('#myModal').modal('show');

            })


        });
        </script>
@endsection
