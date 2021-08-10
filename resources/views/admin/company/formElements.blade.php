<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Name: ', ['class' => 'control-label']) }} <span class="star">*</span>
                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'maxlength' => '200']) }}
                    <label class="help-block error"></label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('manager_email', 'Manager Email: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    {{ Form::text('manager_email', null, ['id' => 'manager_email', 'class' => 'form-control', 'maxlength' => '150']) }}
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
                    <a href="{{ route('company.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
