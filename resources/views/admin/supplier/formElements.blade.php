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
                    {{ Form::label('email', 'Email: ', ['class' => 'control-label']) }} <span class="star">*</span>
                    {{ Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'maxlength' => '100']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('contact_person', 'Contact person: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    {{ Form::text('contact_person', null, ['id' => 'contact_person', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('mobile_number', 'Mobile number: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('mobile_number', null, ['id' => 'mobile_number', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('address', 'Address: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control']) }}
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
                    <a href="{{ route('supplier.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
