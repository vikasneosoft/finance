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
        </div>
        <div class="row">
            @if (isset($role))
                <div class="col-md-offset-2 col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="check-all-permissions">
                                    <input type="checkbox" id="check-all-permissions" value="dsd"> Select All
                                </label>
                            </div>
                        </div>
                    </div>
                    <strong>Permission:</strong>
                    <br />
                    <div class="col-md-12">
                        @foreach ($permissions as $key => $value)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="{{ $key }}">
                                            {{ Form::checkbox('permissions[]', $value['id'], in_array($value['id'], $rolePermissions) ? true : false, ['id' => $key, 'class' => 'name permisssions']) }}
                                            {{ $value['name'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-md-offset-2 col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="check-all-permissions">
                                    <input type="checkbox" id="check-all-permissions" value="dsd"> Select All
                                </label>
                            </div>
                        </div>
                    </div>
                    <strong>Permission:</strong>
                    <br />
                    <div class="col-md-12">
                        @foreach ($permissions as $key => $value)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="{{ $key }}">
                                            {{ Form::checkbox('permissions[]', $value['id'], in_array($value['id'], $rolePermissions) ? true : false, ['id' => $key, 'class' => 'name permisssions']) }}
                                            {{ $value['name'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>



        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
