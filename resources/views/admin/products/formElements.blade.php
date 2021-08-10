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
                    {{ Form::label('price', 'Price: ', ['class' => 'control-label']) }} <span class="star">*</span>
                    {{ Form::text('price', null, ['id' => 'price', 'class' => 'form-control', 'maxlength' => '100']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('category_id', 'Category: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($categories))
                        {{ Form::select('category_id', array_replace(['' => 'Select'], $categories), null, ['class' => 'form-control', 'id' => 'role_id']) }}
                    @else
                        {{ Form::select('category_id', ['' => 'Empty'], null, ['class' => 'form-control', 'id' => 'role_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>


            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('image', 'Image: ', ['class' => 'control-label']) }}
                    {{ Form::file('image', ['id' => 'image']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    {{ Form::label('description', 'Description: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    {{ Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'maxlength' => '100']) }}
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
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
