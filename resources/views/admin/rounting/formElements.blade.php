<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('employee_id', 'Employee: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($employes))
                        {{ Form::select('employee_id', array_replace(['' => 'Select'], $employes), null, ['class' => 'form-control', 'id' => 'employee_id']) }}
                    @else
                        {{ Form::select('employee_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'employee_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('level', 'Level: ', ['class' => 'control-label']) }} <span class="star">*</span>
                    @if (isset($rounting))
                        <select name="level" id="level" class="form-control">
                            <option>Select</option>
                            <option @if ($rounting->level == 1) selected @endif value="1">Level 1</option>
                            <option @if ($rounting->level == 2) selected @endif value="2">Level 2</option>
                            <option @if ($rounting->level == 3) selected @endif value="3">Level 3</option>
                            <option @if ($rounting->level == 4) selected @endif value="4">Level 4</option>
                            <option @if ($rounting->level == 5) selected @endif value="5">Level 5</option>
                        </select>
                    @else
                        <select name="level" id="level" class="form-control">
                            <option>Select</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                            <option value="5">Level 5</option>
                        </select>
                    @endif

                    <label class="help-block error"></label>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('manager_id', 'Manager: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($employes))
                        {{ Form::select('manager_id', array_replace(['' => 'Select'], $employes), null, ['class' => 'form-control', 'id' => 'manager_id']) }}
                    @else
                        {{ Form::select('manager_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'manager_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('maximum_amount', 'Maximum amount: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    {{ Form::text('maximum_amount', null, ['id' => 'maximum_amount', 'class' => 'form-control', 'maxlength' => '100']) }}
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
                    <a href="{{ route('rounting.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
