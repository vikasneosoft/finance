<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('financial_year', 'Financial year: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    {{ Form::text('financial_year', null, ['id' => 'financial_year', 'class' => 'form-control', 'maxlength' => '10']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('company_id', 'Company: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($companies))
                        {{ Form::select('company_id', array_replace(['' => 'Select'], $companies), null, ['class' => 'form-control', 'id' => 'company_id']) }}
                    @else
                        {{ Form::select('company_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'company_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('location_id', 'Location: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="location_id" class="form-control" name="location_id">
                        <option value="">Select</option>
                        @if (isset($locations))
                            @foreach ($locations as $key => $value)
                                <option @if ($budget->location_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('division_id', 'Division: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="division_id" class="form-control" name="division_id">
                        <option value="">Select</option>
                        @if (isset($divisions))
                            @foreach ($divisions as $key => $value)
                                <option @if ($budget->division_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('department_id', 'Department: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="department_id" class="form-control" name="department_id">
                        <option value="">Select</option>
                        @if (isset($departments))
                            @foreach ($departments as $key => $value)
                                <option @if ($budget->department_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('section_id', 'Section: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="section_id" class="form-control" name="section_id">
                        <option value="">Select</option>
                        @if (isset($sections))
                            @foreach ($sections as $key => $value)
                                <option @if ($budget->section_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_category_id', 'Category: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($categories))
                        {{ Form::select('budget_category_id', array_replace(['' => 'Select'], $categories), null, ['class' => 'form-control', 'id' => 'budget_category_id']) }}
                    @else
                        {{ Form::select('budget_category_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_category_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">

                    {{ Form::label('budget_subcategory_id', 'Subcategory: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>


                    <select id="budget_subcategory_id" class="form-control" name="budget_subcategory_id">
                        @if (isset($subcategories))
                            @foreach ($subcategories as $key => $value)
                                <option @if ($budget->budget_subcategory_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>


                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_type_id', 'Budget type : ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($budgetTypes))
                        {{ Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                    @else
                        {{ Form::select('budget_type_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_for', 'Budget for: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('budget_for', null, ['id' => 'budget_for', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_quantity', 'Quantity: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('budget_quantity', null, ['id' => 'budget_quantity', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_rate', 'Rate: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('budget_rate', null, ['id' => 'budget_rate', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_amount', 'Amount: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('budget_amount', null, ['id' => 'budget_amount', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_vendor', 'Vendor: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('budget_vendor', null, ['id' => 'budget_vendor', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_from_date', 'From date: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (isset($budget))
                        <input type="text"
                            value="{{ Carbon\Carbon::parse($budget->budget_from_date)->format('d-m-Y') }}"
                            id="budget_from_date" class="form-control" name="budget_from_date" />
                    @else
                        {{ Form::text('budget_from_date', null, ['id' => 'budget_from_date', 'class' => 'form-control']) }}
                    @endif

                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_to_date', 'To date: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (isset($budget))
                        <input type="text"
                            value="{{ Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y') }}"
                            id="budget_to_date" class="form-control" name="budget_to_date" />
                    @else
                        {{ Form::text('budget_to_date', null, ['id' => 'budget_to_date', 'class' => 'form-control']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_proj_ref_no', 'Project ref no: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('budget_proj_ref_no', null, ['id' => 'budget_proj_ref_no', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_explanation', 'Explanation: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::textarea('budget_explanation', null, ['id' => 'budget_explanation', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <a href="{{ route('budget.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
