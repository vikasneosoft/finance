<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Name: ', ['class' => 'control-label']) }} <span class="star">*</span>
                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'maxlength' => '100']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('budget_category_id', 'Category: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($categories))
                        {{ Form::select('budget_category_id', array_replace(['' => 'Select'], $categories), null, ['class' => 'form-control', 'id' => 'role_id']) }}
                    @else
                        {{ Form::select('budget_category_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_category_id']) }}
                    @endif
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
                    <a href="{{ route('subcategory.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
