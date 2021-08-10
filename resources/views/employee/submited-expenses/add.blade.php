@extends('employee.layout')
@section('title')
    Add Expenses
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
                                <a href="{{ route('budget.index') }}">Expensives</a>
                            </li>
                            <li class="breadcrumb-item active">Add Expensive</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div id="header-form" class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Header Information
                                </h3>
                            </div>
                            {{ Form::open(['method' => 'POST', 'id' => 'add-expensive-form']) }}
                            <input type="hidden" value={{ $budget->id }} name="budget_id" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('financial_year', 'Financial year: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($fincialYears))
                                                {{ Form::select('financial_year', array_replace(['' => 'Select'], $fincialYears), $budget->financial_year, ['class' => 'form-control', 'id' => 'financial_year']) }}
                                            @else
                                                {{ Form::select('financial_year', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'financial_year']) }}
                                            @endif
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {{ Form::label('project_code_id', 'Project Codes: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($projectCodes))
                                                {{ Form::select('project_code_id', array_replace(['' => 'Select'], $projectCodes), $budget->project_code_id, ['class' => 'form-control', 'id' => 'project_code_id']) }}
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
                                                {{ Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), $budget->budget_type_id, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                                            @else
                                                {{ Form::select('budget_type_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                                            @endif
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('budget_proj_ref_no', 'Project ref no: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('proj_ref_no', $budget->budget_proj_ref_no, ['id' => 'proj_ref_no', 'class' => 'form-control']) }}
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
                                                {{ Form::select('cost_center_id', array_replace(['' => 'Select'], $costCenters), $budget->cost_center_id, ['class' => 'form-control', 'id' => 'cost_center_id']) }}
                                            @else
                                                {{ Form::select('cost_center_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'cost_center_id']) }}
                                            @endif
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {{ Form::label('project_in_charge', 'Project Incharge: ', ['class' => 'control-label']) }}<span
                                                class="star">*</span>
                                            {{ Form::text('project_in_charge', $budget->project_in_charge, ['id' => 'project_in_charge', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('vendor', 'Vendor: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('vendor', $budget->vendor, ['id' => 'vendor', 'class' => 'form-control']) }}

                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('payment_terms', 'Payment terms: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('payment_terms', null, ['id' => 'payment_terms', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('vendor_contacts', 'Vendor Contacts: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('vendor_contacts', $budget->vendor_contacts, ['id' => 'vendor_contacts', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('assumptions_or_inclusions', 'Assumptions or inclusions: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('assumptions_or_inclusions', null, ['id' => 'assumptions_or_inclusions', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('vendor', 'Reason for selecting vendor: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('reason_for_selecting_vendor', null, ['id' => 'reason_for_selecting_vendor', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('exceptions_or_exclusions', 'Exceptions or exclusions: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('exceptions_or_exclusions', null, ['id' => 'exceptions_or_exclusions', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('expensive_code', 'Expense code: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('expensive_code', $budget->budget_code, ['id' => 'expensive_code', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('from_date', 'Start date: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            <input type="text"
                                                value="{{ Carbon\Carbon::parse($budget->budget_from_date)->format('d-m-Y') }}"
                                                id="from_date" class="form-control" name="from_date" />
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('warranty_guarantee_details', 'Warranty guarantee details: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('warranty_guarantee_details', null, ['id' => 'warranty_guarantee_details', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('to_date', 'End date: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            <input type="text"
                                                value="{{ Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y') }}"
                                                id="to_date" class="form-control" name="to_date" />

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('what_is_required', 'What is required: ', ['class' => 'control-label']) }}

                                            {{ Form::text('what_is_required', null, ['id' => 'what_is_required', 'class' => 'form-control']) }}
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
                                            {{ Form::label('why_required', 'Why is it required: ', ['class' => 'control-label']) }}
                                            {{ Form::text('why_required', null, ['id' => 'why_required', 'class' => 'form-control']) }}
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
                                            {{ Form::label('location_id', 'Services are required at: ', ['class' => 'control-label']) }}

                                            <span class="star">*</span>
                                            @if (count($locations))
                                                {{ Form::select('location_id', array_replace(['' => 'Select'], $locations), null, ['class' => 'form-control', 'id' => 'location_id']) }}
                                            @else
                                                {{ Form::select('location_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'location_id']) }}
                                            @endif


                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save-btn']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <a href="{{ route('budget.index') }}"
                                                class="btn btn-default float-center">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="#"
                                                class="d-none delete-expenses btn btn-danger float-center">Delete</a>
                                            <a href="#" class="d-none load-form-element btn btn-success float-center">Add
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div style="display:none" id="budget-detail-div" class="row">
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
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div id="form-elements" class="xx-row"></div>
            </div>

        </section>
        <input type="hidden" id="return-back-route" value={{ route('budget.index') }} />
        <input type="hidden" id="add-expensive-route" value={{ route('expensive.add_expensive') }} />
        <input type="hidden" id="load-expensive-detail-form-route"
            value={{ route('expensive.view_add_expensive_detail') }} />
        <input type="hidden" id="add-expensive-detail-route" value={{ route('expensive.add_expensive_detail') }} />
        <input type="hidden" id="expensive-detail-edit-view-route"
            value={{ route('expensive_detail.expensive_detail_edit_view') }} />
        <input type="hidden" id="expensive-detail-update"
            value={{ route('expensive_detail.update_expensive_detail') }} />
        <input type="hidden" id="expensive-id" value="0" />
        <input type="hidden" id="budget-id" value="{{ $budget->id }}" />
        <input type="hidden" id="get-budget-category-route" value={{ route('common.get_subcategory') }} />
        <input type="hidden" id="expensive-delete-route" value={{ route('expensive.delete') }} />
        <input type="hidden" id="expensive-detail-delete-route" value={{ route('expensive_detail.delete') }} />

    </div>
@endsection
@section('employee-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('public/js/expensive.js') }}"></script>
@endsection
