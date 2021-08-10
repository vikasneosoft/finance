@extends('employee.layout')
@section('title')
    Edit Expenses
@endsection
@section('employee-css')
    <link href="{{ asset('public/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('employee-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Expenses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('expenses.get_expenses', $expense['budget_id']) }} ">Expense</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Expense</li>
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
                            <div id="header-form" class="card-body">
                                {{ Form::model($expense, ['id' => 'edit-expensive-form']) }}
                                {{ Form::hidden('action', 'edit') }}
                                {{ Form::hidden('id', $expense['id'], ['id' => 'id']) }}
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('financial_year', 'Financial year: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($fincialYears))
                                                {{ Form::select('financial_year', array_replace(['' => 'Select'], $fincialYears), null, ['class' => 'form-control', 'id' => 'financial_year','disabled' => true]) }}
                                            @else
                                                {{ Form::select('financial_year', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'financial_year','disabled' => true]) }}
                                            @endif
                                            {{ Form::hidden('financial_year', $expense->financial_year) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('project_code_id', 'Project Codes: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($projectCodes))
                                                {{ Form::select('project_code_id', array_replace(['' => 'Select'], $projectCodes), null, ['class' => 'form-control', 'id' => 'project_code_id']) }}
                                            @else
                                                {{ Form::select('project_code_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'project_code_id']) }}
                                            @endif
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('budget_type_id', 'Expense type : ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($budgetTypes))
                                                {{ Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), null, ['class' => 'form-control', 'id' => 'budget_type_id','disabled' => true]) }}
                                            @else
                                                {{ Form::select('budget_type_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                                            @endif
                                            {{ Form::hidden('budget_type_id', $expense->budget_type_id) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('proj_ref_no', 'Project ref no: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('proj_ref_no', null, ['id' => 'proj_ref_no', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('cost_center_id', 'Cost Cnter: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($costCenters))
                                                {{ Form::select('cost_center_id', array_replace(['' => 'Select'], $costCenters), null, ['class' => 'form-control', 'id' => 'cost_center_id','disabled' => true]) }}
                                            @else
                                                {{ Form::select('cost_center_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'cost_center_id']) }}
                                            @endif
                                            <label class="d-none help-block error"></label>
                                            {{ Form::hidden('cost_center_id', $expense->cost_center_id) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {{ Form::label('project_in_charge', 'Project Incharge: ', ['class' => 'control-label']) }}<span
                                                class="star">*</span>
                                            {{ Form::text('project_in_charge', null, ['id' => 'project_in_charge', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('expensive_code', 'Budget code: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('expensive_code', null, ['id' => 'expensive_code', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{ Form::label('from_date', 'Start date: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            <input type="text"
                                                value="{{ Carbon\Carbon::parse($expense->from_date)->format('d-m-Y') }}"
                                                id="from_date" class="form-control" name="from_date" />
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{ Form::label('to_date', 'End date: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            <input type="text"
                                                value="{{ Carbon\Carbon::parse($expense->to_date)->format('d-m-Y') }}"
                                                id="to_date" class="form-control" name="to_date" />

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('vendor', 'Vendor: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('vendor', null, ['id' => 'vendor', 'class' => 'form-control']) }}

                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('what_is_required', 'What is required: ', ['class' => 'control-label']) }}

                                            {{ Form::text('what_is_required', null, ['id' => 'what_is_required', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('vendor_contacts', 'Vendor Contacts: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('vendor_contacts', null, ['id' => 'vendor_contacts', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('why_required', 'Why is it required: ', ['class' => 'control-label']) }}
                                            {{ Form::text('why_required', null, ['id' => 'warranty_guarantee_details', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('reason_for_selecting_vendor', 'Reason for selecting vendor: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('reason_for_selecting_vendor', null, ['id' => 'reason_for_selecting_vendor', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {{ Form::label('warranty_guarantee_details', 'Warranty guarantee details: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('warranty_guarantee_details', null, ['id' => 'warranty_guarantee_details', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('payment_terms', 'Payment terms: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('payment_terms', null, ['id' => 'payment_terms', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {{ Form::label('scope_of_work', 'Scope of work: ', ['class' => 'control-label']) }}
                                            {{ Form::text('scope_of_work', null, ['id' => 'scope_of_work', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">

                                        <div class="form-group">
                                            {{ Form::label('assumptions_or_inclusions', 'Assumptions or inclusions: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('assumptions_or_inclusions', null, ['id' => 'assumptions_or_inclusions', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('what_will_change', 'What will change: ', ['class' => 'control-label']) }}
                                            {{ Form::text('what_will_change', null, ['id' => 'what_will_change', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('exceptions_or_exclusions', 'Exceptions or exclusions: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('exceptions_or_exclusions', null, ['id' => 'exceptions_or_exclusions', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('location_id', 'Services are required at: ', ['class' => 'control-label']) }}

                                            @if (count($locations))
                                                {{ Form::select('location_id', array_replace(['' => 'Select'], $locations), null, ['class' => 'form-control', 'id' => 'location_id']) }}
                                            @else
                                                {{ Form::select('location_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'location_id']) }}
                                            @endif


                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>

                                @if (in_array($expense['employee_id'], findUserOfSameLevel()))
                                    @if ($expense['submited'] == 0)
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <a href="{{ route('expenses.get_expenses', ['id' => $expense->budget_id]) }}"
                                                        class="btn btn-default float-center">Back</a>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <a href="#" class="delete-expenses btn btn-danger float-center">Delete</a>

                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <a href="#" data-budgetId="{{$expense->budget_id}}" data-expense={{$expenseAmount}} data-budget={{array_sum(array_column($budget->budgetDetail->toArray(), 'budget_amount'))}} data-id={{ $expense['id'] }}
                                                        class="btn submit-for-approval btn-success float-center">Submit for
                                                        approval</a>
                                                        @include('flash::message')
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <div class="card @if($expense['is_approved']==0)card-warning @elseif($expense['is_approved']==1)card-success @else card-danger @endif">
                                                <div class="card-header">
                                                  <h3 class="card-title">@if ($expense['is_approved'] == 0)
                                                    Expense is submitted for approval
                                                @elseif($expense['is_approved']==1)
                                                    Approved
                                                @else
                                                    Rejected
                                                @endif</h3>
                                                </div>

                                              </div>

                                        </div>
                                    @endif
                                @endif
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

            <div id="budget-detail-div" style="padding: 0px 0px 0px 15px;" class="row">
                <h4>Budget Detail</h4>
                <div class="col-12 table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="thead-color">
                            <tr>
                                <th>Bud For</th>
                                <th class="right-side-text">Bud Qty</th>
                                <th class="right-side-text">Rate</th>
                                <th class="right-side-text">Bud Amt</th>
                                <th class="right-side-text">Sub Qty</th>
                                <th class="right-side-text">Exp Amt</th>
                                <th class="right-side-text">Sub Amt</th>
                                <th class="right-side-text">Balance</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($expenseDetail as $key => $value)
                                <tr class="tr-{{ $value['id'] }}">
                                    <td>{{ $value['budget_for'] }}</td>
                                    <td class="right-side-text">{{ $value['budget_quantity'] }} </td>
                                    <td class="right-side-text">{{ IND_money_format($value['budget_rate']) }} </td>
                                    <td class="right-side-text">{{ IND_money_format($value['budget_amount']) }} </td>
                                    <td class="right-side-text">@if(isset($value['expense_quantity']))
                                        {{ $value['expense_quantity'] }}
                                        @else
                                        --
                                        @endif
                                    </td>
                                    <td class="right-side-text">
                                        {{$budget['expenseDetail'][$key]['amount']-$value['expense_amount']}}
                                    </td>
                                    <td class="right-side-text">
                                        @if(isset($value['expense_amount']))
                                            {{ IND_money_format($value['expense_amount']) }}
                                        @else
                                        --
                                        @endif

                                    </td>
                                    <td class="right-side-text">
                                        @if(isset($value['balance']))
                                            {{ IND_money_format($value['balance']) }}
                                        @else
                                        --
                                        @endif
                                    </td>
                                    <td>{{ $value['cat_name'] }}</td>
                                    <td>{{ $value['sub_cat_name'] }}</td>
                                    <td>

                                        @if (in_array($expense['employee_id'], findUserOfSameLevel()))
                                            @if($expense['submited']==0)
                                                <a href="#" data-balance=@if(isset($value['balance'])){{$value['balance']}} @else 1 @endif data-id="{{ $value['id'] }}" class="load-form-element">Add Detail</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div id="expense-detail-div"  style="padding: 0px 0px 0px 15px;" class="row">
                <h4>Expense Detail</h4>
                <div class="col-md-12 col-md-offset-2 table-responsive">
                    <table id="load-table" class="table table-sm table-striped">
                        <thead class="thead-color">
                            <tr>
                                <th>Exp For</th>
                                {{-- <th>Specifications</th> --}}
                                <th class="right-side-text">Quantity</th>
                                <th class="right-side-text">Rate</th>
                                <th class="right-side-text">Exp Amt</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                {{-- <th>Justification or Detailing</th>
                                <th>Fileupload</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($expense))
                                @php  $total = 0 ; @endphp
                                @foreach ($expense->expenseDetail as $value)
                                    @php $total+=$value['expensive_amount']; @endphp
                                    <tr class="tr-{{ $value['id'] }}">
                                        <td>{{ $value['expensive_for'] }}</td>
                                        {{-- <td>{{ $value['specifications'] }}</td> --}}
                                        <td class="right-side-text">{{ $value['expensive_quantity'] }} </td>
                                        <td class="right-side-text">{{ IND_money_format($value['expensive_rate']) }} </td>
                                        <td class="right-side-text">{{ IND_money_format($value['expensive_amount']) }} </td>

                                        <td>{{ $value['category_name'] }}</td>
                                        <td>{{ $value['subcategory_name'] }}</td>
                                       {{--  <td>{{ $value['expensive_explanation'] }}</td>
                                        <td>
                                            @if (!empty($value['image']))
                                                <a target="_blank"
                                                    href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                                                    File</a>
                                            @else
                                                --
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if (in_array($expense['employee_id'], findUserOfSameLevel()))
                                                @if ($expense['submited'] == 0)
                                                    <a href="#" data-id="{{ $value['id'] }}" class="edit-detail"><i
                                                            class="far fa-edit" style="font-size: 20px;"></i></a>
                                                    <a data-id="{{ $value['id'] }}" href="#" class="delete-detail"><i
                                                            class="fas fa-trash-alt" style="font-size: 20px;"></i></a>
                                                @else
                                                    --
                                                @endif
                                            @endif
                                        </td>
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
    </div>
    </section>

    </div>
    <input type="hidden" id="return-back-route" value={{ route('budget.index') }} />
    <input type="hidden" id="update-expensive-route" value={{ route('expensive.update_expensive') }} />
    <input type="hidden" id="expensive-detail-edit-view-route"
        value={{ route('expensive_detail.expensive_detail_edit_view') }} />
    <input type="hidden" id="expensive-detail-update" value={{ route('expensive_detail.update_expensive_detail') }} />
    <input type="hidden" id="load-expensive-detail-form-route"
        value={{ route('expensive.view_add_expensive_detail') }} />
    <input type="hidden" id="add-expensive-detail-route" value={{ route('expensive.add_expensive_detail') }} />
    <input type="hidden" id="expensive-id" value="{{ $expense->id }}" />
    <input type="hidden" id="budget-id" value="{{ $expense->budget_id }}" />

    <input type="hidden" id="get-budget-category-route" value={{ route('common.get_subcategory') }} />

    <input type="hidden" id="expensive-delete-route" value={{ route('expensive.delete') }} />
    <input type="hidden" id="expensive-detail-delete-route" value={{ route('expensive_detail.delete') }} />

    <input type="hidden" id="expense-submit-route" value={{ route('expenses.submit_expenses') }} />
    <input type="hidden" id="total-amount" value={{ $total }} />
@endsection
@section('employee-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('public/js/expensive.js') }}"></script>

@endsection
