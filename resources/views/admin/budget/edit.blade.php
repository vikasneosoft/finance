@extends('admin.layout')
@section('title')
    Add Budget
@endsection
@section('admin-css')
    <link href="{{ asset('public/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('admin-content')
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">

                            <div class="row">

                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <strong>User</strong>: {{ $user->name }}<br>
                                        <strong>Company</strong>: {{ $user->company['name'] }}<br>
                                        <strong>Location</strong>: {{ $user->location['name'] }}<br>
                                        <strong>Division</strong>: {{ $user->division['name'] }}<br>
                                        <strong>Department</strong>: {{ $user->department['name'] }}<br>
                                        <strong>Section</strong>: {{ $user->section['name'] }}<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <strong>Financial Year</strong>:{{ $budget->financial_year }}<br>
                                        <strong>Cost Cnter</strong>:--<br>
                                        <strong>Project Codes</strong>:--<br>
                                        <strong>Project Inchage</strong>:--<br>
                                        <strong>Budget ID</strong>:--{{ $budget->id }}<br>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <a href="#" class="load-form-element btn btn-success btn-sm">+</a><br>

                                    </address>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budget->budgetDetail as $value)
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
                                                    <td><a href="#" data-id="{{ $value['id'] }}"
                                                            class="edit-detail btn-success btn-sm">Edit</a>
                                                        <a data-id="{{ $value['id'] }}" href="#"
                                                            class="delete-detail btn-danger btn-sm">Delete</a>
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

                    </div>
                </div>
            </div>
        </section>

    </div>
    <input type="hidden" id="load-budget-detail-route" value={{ route('budgets.add_budget_view') }} />
    <input type="hidden" id="add-budget-detail-route" value={{ route('budgets.add_budget') }} />
    <input type="hidden" id="budget-id" value="{{ $budget->id }}" />
    <input type="hidden" id="get-budget-category-route" value={{ route('budgets.get_subcategory') }} />
    <input type="hidden" id="budget-detail-edit-view-route" value={{ route('budgets.budget_detail_edit_view_route') }} />
    <input type="hidden" id="budget-detail-update" value={{ route('budget_details.update') }} />
    <input type="hidden" id="budget-detail-delete-route" value={{ route('budget_details.delete') }} />
    <input type="text" id="employee-id" value={{ $user->id }} />
@endsection
@section('admin-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('public/js/admin-add-budget-detail.js') }}"></script>

@endsection
