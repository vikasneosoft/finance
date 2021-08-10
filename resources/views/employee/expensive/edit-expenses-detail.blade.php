@extends('employee.layout')
@section('title')
    Edit Expense detail
@endsection
@section('employee-css')
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
                                <h3 class="card-title">Expense Detail
                                </h3>
                            </div>
                            {{ Form::model($expensiveDetail, ['id' => 'edit-form']) }}
                            <div class="card-body">
                                {{ Form::hidden('action', 'edit') }}
                                {{ Form::hidden('id', $expensiveDetail['id'], ['id' => 'id']) }}
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('expensive_for', 'Expense for: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('expensive_for', null, ['id' => 'expensive_for', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('expensive_quantity', 'Quantity: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('expensive_quantity', null, ['id' => 'expensive_quantity', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('specifications', 'Specifications: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('specifications', null, ['id' => 'specifications', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('expensive_rate', 'Rate: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            {{ Form::text('expensive_rate', null, ['id' => 'expensive_rate', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('budget_category_id', 'Category: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            @if (count($categories))
                                                {{ Form::select('budget_category_id', array_replace(['' => 'Select'], $categories), null, ['class' => 'form-control', 'id' => 'budget_category_id']) }}
                                            @else
                                                {{ Form::select('budget_category_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_category_id']) }}
                                            @endif
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('image', 'Image: ', ['class' => 'control-label']) }}<span
                                                class="star">*</span>
                                            @if (isset($expensiveDetail))
                                                <a target="_blank"
                                                    href="{{ URL::asset('/public/budget_images/' . $expensiveDetail->image) }}">View
                                                    File</a>
                                            @endif
                                            {{ Form::file('image', ['id' => 'image']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">

                                            {{ Form::label('budget_subcategory_id', 'Subcategory: ', ['class' => 'control-label']) }}
                                            <span class="star">*</span>
                                            <select id="budget_subcategory_id" class="form-control"
                                                name="budget_subcategory_id">
                                                <option value="">Select</option>
                                                @if (isset($subcategories))
                                                    @foreach ($subcategories as $key => $value)
                                                        <option @if ($expensiveDetail->budget_subcategory_id == $value['id']) selected @endif
                                                            value="{{ $value['id'] }}">
                                                            {{ $value['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('expensive_explanation', 'Justification: ', ['class' => 'control-label']) }}

                                            {{ Form::textarea('expensive_explanation', null, ['id' => 'expensive_explanation', 'class' => 'form-control']) }}
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="{{ route('budget.index') }}"
                                                class="btn btn-default float-center">Cancel</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <input type="hidden" id="return-back-route"
        value={{ route('expenses.get_expenses', ['id' => $expensiveDetail['budget_id']]) }} />

    <input type="hidden" id="expensive-detail-update" value={{ route('expensive_detail.update_expensive_detail') }} />


    <input type="hidden" id="get-budget-category-route" value={{ route('common.get_subcategory') }} />

@endsection
@section('employee-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/expensive-detail.js') }}"></script>

@endsection
