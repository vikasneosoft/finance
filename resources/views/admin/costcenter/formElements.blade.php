<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Cost center: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'maxlength' => '100']) }}
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
                    <a href="{{ route('cost-center.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
