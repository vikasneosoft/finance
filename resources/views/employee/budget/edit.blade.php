@extends('employee.layout')
@section('title')
    Edit Budget
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
                            <li class="breadcrumb-item active">Edit Budget</li>
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
                            {{ Form::model($budget, ['id' => 'edit-budget-form']) }}
                            {{ Form::hidden('action', 'edit') }}
                            {{ Form::hidden('id', $budget['id'], ['id' => 'id']) }}
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('financial_year', 'Financial year: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                @if (count($fincialYears))
                                                    {{ Form::select('financial_year', array_replace(['' => 'Select'], $fincialYears), null, ['class' => 'form-control', 'id' => 'financial_year']) }}
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
                                                {{ Form::label('budget_type_id', 'Budget type : ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                @if (count($budgetTypes))
                                                    {{ Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
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
                                                {{ Form::text('budget_proj_ref_no', null, ['id' => 'budget_proj_ref_no', 'class' => 'form-control']) }}
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
                                                    {{ Form::select('cost_center_id', array_replace(['' => 'Select'], $costCenters), null, ['class' => 'form-control', 'id' => 'cost_center_id']) }}
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
                                                {{ Form::text('project_in_charge', null, ['id' => 'project_in_charge', 'class' => 'form-control']) }}
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {{ Form::label('budget_from_date', 'Start date: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                <input type="text"
                                                    value="{{ Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y') }}"
                                                    id="budget_from_date" class="form-control" name="budget_from_date" />
                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {{ Form::label('budget_to_date', 'End date: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                <input type="text"
                                                    value="{{ Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y') }}"
                                                    id="budget_to_date" class="form-control" name="budget_to_date" />
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
                                                {{ Form::label('budget_code', 'Budget code: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                {{ Form::text('budget_code', null, ['id' => 'budget_code', 'class' => 'form-control']) }}
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            {{ Form::label('division_id', 'Division: ', ['class' => 'control-label']) }}
                                            @if (Auth::user()->division_id == 0)
                                                <div class="form-group">

                                                    <select id="division_id" class="form-control" name="division_id">
                                                        @if (isset($divisions))
                                                            @foreach ($divisions as $key => $value)
                                                                <option @if ($budget->division_id == $value['id']) selected @endif
                                                                    value="{{ $value['id'] }}">
                                                                    {{ $value['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <label class="d-none help-block error"></label>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    @if (isset(userDetail()->division['name']))
                                                        {{ userDetail()->division['name'] }}
                                                    @endif
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('location_id', 'Location: ', ['class' => 'control-label']) }}
                                                @if (Auth::user()->location_id == 0)
                                                <select id="location_id" class="form-control" name="location_id">
                                                    @if (isset($locations))
                                                        @foreach ($locations as $key => $value)
                                                            <option @if ($budget->location_id == $value['id']) selected @endif
                                                                value="{{ $value['id'] }}">
                                                                {{ $value['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @else
                                                <div class="form-group">
                                                {{ userDetail()->location['name'] }}
                                                </div>
                                                @endif
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-offset-2 col-md-6">
                                            {{ Form::label('department_id', 'Department: ', ['class' => 'control-label']) }}
                                            @if (Auth::user()->department_id == 0)

                                                <div class="form-group">

                                                    <select id="department_id" class="form-control" name="department_id">
                                                        @if (isset($departments))
                                                            @foreach ($departments as $key => $value)
                                                                <option @if ($budget->department_id == $value['id']) selected @endif
                                                                    value="{{ $value['id'] }}">
                                                                    {{ $value['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <label class="d-none help-block error"></label>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    @if (isset(userDetail()->department['name']))
                                                        {{ userDetail()->department['name'] }}
                                                    @endif
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                {{ Form::label('section_id', 'Section: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                <select id="section_id" class="form-control" name="section_id">
                                                    @if (isset($sections))
                                                        @foreach ($sections as $key => $value)
                                                            <option @if ($budget->section_id == $value['id']) selected @endif
                                                                value="{{ $value['id'] }}">
                                                                {{ $value['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update</button>
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
                                                    class="d-none delete-budget btn btn-danger float-center">Delete</a>
                                                <a href="#"
                                                    class="x-d-none load-form-element btn btn-success float-center">Add
                                                    Detail</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div id="budget-detail-div" class="row">
                    <div class="col-12 table-responsive">
                        <table id="load-table" class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th>Budget For</th>
                                    {{-- <th>Specifications</th> --}}
                                    <th class="right-side-text">Quantity</th>
                                    <th class="right-side-text"> Rate</th>
                                    <th class="right-side-text">Budget Amt</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    {{-- <th>Justification or Detailing</th> --}}
                                    <th>More Detail</th>
                                    <th>Fileupload</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($budget->budgetDetail as $value)
                                    <tr class="tr-{{ $value['id'] }}">
                                        <td>{{ $value['budget_for'] }}</td>
                                        {{-- <td>{{ $value['specifications'] }}</td> --}}
                                        <td class="right-side-text">{{ $value['budget_quantity'] }} </td>
                                        <td class="right-side-text">{{ IND_money_format($value['budget_rate']) }} </td>
                                        <td class="right-side-text">{{ IND_money_format($value['budget_amount']) }} </td>
                                        <td>{{ $value['category_name'] }}</td>
                                        <td>{{ $value['subcategory_name'] }}</td>
                                       {{--  <td>{{ $value['budget_explanation'] }}</td> --}}
                                        <td><a id="more-detail" data-explanation="{{$value['budget_explanation']}}" data-specification="{{$value['specifications']}}" href="#">Click </a></td>
                                        <td>
                                            @if (!empty($value['image']))
                                                <a target="_blank"
                                                    href="{{ URL::asset('/public/budget_images/' . $value['image']) }}">View
                                                    File</a>
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td><a href="#" data-id="{{ $value['id'] }}" title="Update"
                                                class="edit-detail"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                                            <a data-id="{{ $value['id'] }}" title="Delete" href="#"
                                                class="delete-detail"><i class="fas fa-trash-alt"
                                                    style="font-size: 20px;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div id="form-elements" class="xx-row">

                </div>
            </div>
        </section>

    </div>
    <input type="hidden" id="return-back-route" value={{ route('budget.index') }} />
    <input type="hidden" id="update-budget-route" value={{ route('budget.update', 'id') }} />

    <input type="hidden" id="load-budget-detail-route" value={{ route('budget.add_budget_view') }} />
    <input type="hidden" id="add-budget-detail-route" value={{ route('budget.add_budget') }} />
    <input type="hidden" id="budget-id" value="{{ $budget->id }}" />
    <input type="hidden" id="get-budget-category-route" value={{ route('common.get_subcategory') }} />
    <input type="hidden" id="budget-detail-edit-view-route" value={{ route('budget.budget_detail_edit_view_route') }} />
    <input type="hidden" id="budget-detail-update" value={{ route('budget_detail.update') }} />
    <input type="hidden" id="budget-detail-delete-route" value={{ route('budget_detail.delete') }} />
    @include('employee.budget.budget-child-detail')
    @endsection
@section('employee-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('public/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('public/js/add-budget-detail.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#division_id').change(function() {
                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    data: {
                        'divisionId': $(this).val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('common.get_departments_by_division') }}",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        $("#section_id").html('<option value="">--Select--</option>');
                        var departments = '<option value="">--Select--</option>';

                        if (response.departments) {
                            $.each(response.departments, function(key, value) {
                                departments +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            $('#department_id').html(departments);
                        } else {
                            $("#department_id").html('');
                        }
                    }
                });
            });

            $('#department_id').change(function() {
                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    data: {
                        'departmentId': $(this).val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('common.get_sections_by_department') }}",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        var sections = '<option value="">--Select--</option>';

                        if (response.sections) {
                            $.each(response.sections, function(key, value) {
                                sections +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            $('#section_id').html(sections);
                        } else {
                            $("#section_id").html('');
                        }
                    }
                });
            });

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
