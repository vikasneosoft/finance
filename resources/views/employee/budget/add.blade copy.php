@extends('employee.layout')
@section('title')
Add Budget
@endsection
@section('employee-css')
<link href="{{ asset('public/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('employee-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Budget</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('budget.index') }}">Budgets</a>
                        </li>
                        <li class="breadcrumb-item active">Add Budget</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        {{ Form::open(['method' => 'POST', 'id' => 'add-budget-form']) }}
                        <div class="row invoice-info">
                            <div class="col-md-12">

                            </div>
                            <div class="col-md-6">

                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">User Defaults</h3>
                                    </div>


                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="budget_code" class="col-sm-4 col-form-label">Budget
                                                Code *</label>
                                            <div class="col-sm-6">
                                                {{ Form::text('budget_code', null, ['id' => 'budget_code', 'class' => 'form-control']) }}
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="budget_type_id" class="col-sm-4 col-form-label">Budget type
                                                *</label>

                                            <div class="col-sm-6">
                                                @if (count($budgetTypes))
                                                {{ Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                                                @else
                                                {{ Form::select('budget_type_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Document Defaults</h3>
                                    </div>

                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="financial_year" class="col-sm-4 col-form-label">Financial
                                                Year *
                                            </label>
                                            <div class="col-sm-6">
                                                @if (count($fincialYears))
                                                {{ Form::select('financial_year', array_replace(['' => 'Select'], $fincialYears), null, ['class' => 'form-control', 'id' => 'financial_year']) }}
                                                @else
                                                {{ Form::select('financial_year', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'financial_year']) }}
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cost_center_id" class="col-sm-4 col-form-label">Cost Cnter *

                                            </label>
                                            <div class="col-sm-6">
                                                @if (count($costCenters))
                                                {{ Form::select('cost_center_id', array_replace(['' => 'Select'], $costCenters), null, ['class' => 'form-control', 'id' => 'cost_center_id']) }}
                                                @else
                                                {{ Form::select('cost_center_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'cost_center_id']) }}
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="project_code_id" class="col-sm-4 col-form-label">Project Codes *
                                            </label>
                                            <div class="col-sm-6">
                                                @if (count($projectCodes))
                                                {{ Form::select('project_code_id', array_replace(['' => 'Select'], $projectCodes), null, ['class' => 'form-control', 'id' => 'project_code_id']) }}
                                                @else
                                                {{ Form::select('project_code_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'project_code_id']) }}
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="project_in_charge" class="col-sm-4 col-form-label">Project
                                                Incharge *
                                            </label>
                                            <div class="col-sm-6">
                                                {{ Form::text('project_in_charge', null, ['id' => 'project_in_charge', 'class' => 'form-control']) }}
                                                <label class="d-none help-block error"></label>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="budget_proj_ref_no" class="col-sm-4 col-form-label">Project ref no*
                                            </label>
                                            <div class="col-sm-6">
                                                {{ Form::text('budget_proj_ref_no', null, ['id' => 'budget_proj_ref_no', 'class' => 'form-control']) }}
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="vendor" class="col-sm-4 col-form-label">Vendor *

                                            </label>
                                            <div class="col-sm-6">
                                                {{ Form::text('vendor', null, ['id' => 'vendor', 'class' => 'form-control']) }}
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="vendor_contacts" class="col-sm-4 col-form-label">Vendor Contacts *

                                            </label>
                                            <div class="col-sm-6">
                                                {{ Form::text('vendor_contacts', null, ['id' => 'vendor_contacts', 'class' => 'form-control']) }}
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="vendor_contacts" class="col-sm-4 col-form-label">From date *

                                            </label>
                                            <div class="col-sm-6">
                                                @if (isset($budget))
                                                <input type="text" value="{{ Carbon\Carbon::parse($budget->budget_from_date)->format('d-m-Y') }}" id="budget_from_date" class="form-control" name="budget_from_date" />
                                                @else
                                                {{ Form::text('budget_from_date', null, ['id' => 'budget_from_date', 'class' => 'form-control']) }}
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="vendor_contacts" class="col-sm-4 col-form-label">To date *

                                            </label>
                                            <div class="col-sm-6">
                                                @if (isset($budget))
                                                <input type="text" value="{{ Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y') }}" id="budget_to_date" class="form-control" name="budget_to_date" />
                                                @else
                                                {{ Form::text('budget_to_date', null, ['id' => 'budget_to_date', 'class' => 'form-control']) }}
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <a href="{{ route('budget.index') }}" class="btn btn-default float-center">Cancel</a>
                                    <a href="#" class="d-none delete-budget btn btn-danger float-center">Delete</a>
                                    <a href="#" class="d-none load-form-element btn btn-success float-right">Add Detail</a>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}

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
                        <!-- /.row -->

                        <div id="form-elements" class="xx-row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="return-back-route" value={{ route('budget.index') }} />
    <input type="hidden" id="load-budget-detail-route" value={{ route('budget.add_budget_view') }} />
    <input type="hidden" id="add-budget-route" value={{ route('budget.store') }} />
    <input type="hidden" id="delete-budget-route" value={{ route('budget.destroy', 'id') }} />
    <input type="hidden" id="add-budget-detail-route" value={{ route('budget.add_budget') }} />
    <input type="hidden" id="budget-id" value="0" />
    <input type="hidden" id="get-budget-category-route" value={{ route('common.get_subcategory') }} />
    <input type="hidden" id="budget-detail-edit-view-route" value={{ route('budget.budget_detail_edit_view_route') }} />

    <input type="hidden" id="budget-detail-update" value={{ route('budget_detail.update') }} />
    <input type="hidden" id="budget-detail-delete-route" value={{ route('budget_detail.delete') }} />

</div>
@endsection
@section('employee-js')
<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('public/js/moment.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('public/js/bootbox.min.js') }}"></script>
<script src="{{ asset('public/js/add-budget-detail.js') }}"></script>


@endsection
