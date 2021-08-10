<div class="modal fade" id="update-password" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    {{ Form::open(['method' => 'POST', 'id' => 'change-password-form']) }}

                    {{ Form::hidden('userId', null, ['class' => 'form-control', 'id' => 'userId']) }}
                    <div class="form-group">
                        {{ Form::label('password', 'New Password: ', ['class' => 'control-label']) }} <span
                            class="star">*</span>
                        {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'maxlength' => '40']) }}
                        <label class="help-block error"></label>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Confirmed Password: ', ['class' => 'control-label']) }}
                        <span class="star">*</span>
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'maxlength' => '40']) }}
                        <label class="help-block error"></label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>


                    {{ Form::close() }}
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn green" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
