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
        @if (!isset($employe))
            <div class="row">
                <div class="col-md-offset-2 col-md-6">
                    <div class="form-group">
                        {{ Form::label('password', 'Password: ', ['class' => 'control-label']) }} <span
                            class="star">*</span>
                        {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'maxlength' => '100']) }}
                        <label class="help-block error"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('confirmed_password', 'Confirmed Password: ', ['class' => 'control-label']) }}
                        <span class="star">*</span>
                        {{ Form::password('confirmed_password', ['id' => 'confirmed_password', 'class' => 'form-control', 'maxlength' => '40']) }}
                        <label class="help-block error"></label>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
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
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('location_id', 'Location: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="location_id" class="form-control" name="location_id">
                        @if (isset($locations))
                            @foreach ($locations as $key => $value)
                                <option @if ($employe->location_id == $value['id']) selected @endif value="{{ $value['id'] }}">
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
                    {{ Form::label('division_id', 'Division: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="division_id" class="form-control" name="division_id">
                        @if (isset($divisions))
                            @foreach ($divisions as $key => $value)
                                <option @if ($employe->division_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label class="help-block error"></label>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('department_id', 'Department: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="department_id" class="form-control" name="department_id">
                        @if (isset($departments))
                            @foreach ($departments as $key => $value)
                                <option @if ($employe->department_id == $value['id']) selected @endif value="{{ $value['id'] }}">
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
                    {{ Form::label('section_id', 'Section: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    <select id="section_id" class="form-control" name="section_id">
                        @if (isset($sections))
                            @foreach ($sections as $key => $value)
                                <option @if ($employe->section_id == $value['id']) selected @endif value="{{ $value['id'] }}">
                                    {{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
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
                    <a href="{{ route('employe.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
