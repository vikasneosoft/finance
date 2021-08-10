<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-12">
                <div class="form-group">
                    {{ Form::label('employe_id', 'Employe: ', ['class' => 'control-label']) }} <span
                        class="star">*</span>
                    @if (count($employes))
                        {{ Form::select('employe_id', array_replace(['' => 'Select'], $employes), null, ['class' => 'form-control', 'id' => 'employe_id']) }}
                    @else
                        {{ Form::select('employe_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'employe_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('level_one_id', 'Level one: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (count($employesEmails))
                        {{ Form::select('level_one_id', array_replace(['' => 'Select'], $employesEmails), null, ['class' => 'form-control', 'id' => 'level_one_id']) }}
                    @else
                        {{ Form::select('level_one_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'level_one_id']) }}
                    @endif

                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('level_one_max', 'Level one max: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('level_one_max', null, ['id' => 'level_one_max', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('level_two_id', 'Level two : ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (count($employesEmails))
                        {{ Form::select('level_two_id', array_replace(['' => 'Select'], $employesEmails), null, ['class' => 'form-control', 'id' => 'level_two_id']) }}
                    @else
                        {{ Form::select('level_two_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'level_two_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('level_two_max', 'Level two max: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('level_two_max', null, ['id' => 'level_two_max', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('level_three_id', 'Level three: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (count($employesEmails))
                        {{ Form::select('level_three_id', array_replace(['' => 'Select'], $employesEmails), null, ['class' => 'form-control', 'id' => 'level_three_id']) }}
                    @else
                        {{ Form::select('level_three_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'level_three_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('level_three_max', 'Level three max: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>

                    {{ Form::text('level_three_max', null, ['id' => 'level_three_max', 'class' => 'form-control']) }}

                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('level_four_id', 'Level four : ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (count($employesEmails))
                        {{ Form::select('level_four_id', array_replace(['' => 'Select'], $employesEmails), null, ['class' => 'form-control', 'id' => 'level_four_id']) }}
                    @else
                        {{ Form::select('level_four_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'level_four_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('level_four_max', 'Level four max: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('level_four_max', null, ['id' => 'level_four_max', 'class' => 'form-control']) }}
                    <label class="help-block error"></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    {{ Form::label('level_five_id', 'Level five : ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    @if (count($employesEmails))
                        {{ Form::select('level_five_id', array_replace(['' => 'Select'], $employesEmails), null, ['class' => 'form-control', 'id' => 'level_five_id']) }}
                    @else
                        {{ Form::select('level_five_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'level_five_id']) }}
                    @endif
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('level_five_max', 'Level five max: ', ['class' => 'control-label']) }}
                    <span class="star">*</span>
                    {{ Form::text('level_five_max', null, ['id' => 'level_five_max', 'class' => 'form-control']) }}
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
                    <a href="{{ route('approval-list.index') }}" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
