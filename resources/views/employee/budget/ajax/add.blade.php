<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Details</h3>
                    </div>
                    {{ Form::open(['method' => 'POST', 'id' => 'add-form', 'file' => true]) }}

                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('budget_for', 'Budget for: ', ['class' => 'control-label']) }}
                                        <span class="star">*</span>
                                        {{ Form::text('budget_for', null, ['id' => 'budget_for', 'class' => 'form-control']) }}
                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('budget_quantity', 'Quantity: ', ['class' => 'control-label']) }}
                                        <span class="star">*</span>
                                        {{ Form::text('budget_quantity', null, ['id' => 'budget_quantity', 'class' => 'form-control']) }}
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
                                        {{ Form::label('budget_rate', 'Rate: ', ['class' => 'control-label']) }}
                                        <span class="star">*</span>
                                        {{ Form::text('budget_rate', null, ['id' => 'budget_rate', 'class' => 'form-control']) }}
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
                                        {{ Form::label('image', 'Image: ', ['class' => 'control-label']) }}
                                        @if (isset($budget))
                                            <a target="_blank"
                                                href="{{ URL::asset('/public/budget_images/' . $budget->image) }}">View
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
                                                    <option @if ($budget->budget_subcategory_id == $value['id']) selected @endif
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
                                        {{ Form::label('budget_explanation', 'Justification: ', ['class' => 'control-label']) }}

                                        {{ Form::textarea('budget_explanation', null, ['id' => 'budget_explanation', 'class' => 'form-control']) }}
                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="#" class="cancel-btn btn btn-default">Cancel</a>
                                    </div>
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
