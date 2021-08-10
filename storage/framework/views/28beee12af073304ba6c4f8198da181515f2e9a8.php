<div class="card-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('employee_id', 'Employee: ', ['class' => 'control-label'])); ?> <span
                        class="star">*</span>
                    <?php if(count($employes)): ?>
                        <?php echo e(Form::select('employee_id', array_replace(['' => 'Select'], $employes), null, ['class' => 'form-control', 'id' => 'employee_id'])); ?>

                    <?php else: ?>
                        <?php echo e(Form::select('employee_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'employee_id'])); ?>

                    <?php endif; ?>
                    <label class="help-block error"></label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('level', 'Level: ', ['class' => 'control-label'])); ?> <span class="star">*</span>
                    <?php if(isset($rounting)): ?>
                        <select name="level" id="level" class="form-control">
                            <option>Select</option>
                            <option <?php if($rounting->level == 1): ?> selected <?php endif; ?> value="1">Level 1</option>
                            <option <?php if($rounting->level == 2): ?> selected <?php endif; ?> value="2">Level 2</option>
                            <option <?php if($rounting->level == 3): ?> selected <?php endif; ?> value="3">Level 3</option>
                            <option <?php if($rounting->level == 4): ?> selected <?php endif; ?> value="4">Level 4</option>
                            <option <?php if($rounting->level == 5): ?> selected <?php endif; ?> value="5">Level 5</option>
                        </select>
                    <?php else: ?>
                        <select name="level" id="level" class="form-control">
                            <option>Select</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                            <option value="5">Level 5</option>
                        </select>
                    <?php endif; ?>

                    <label class="help-block error"></label>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('manager_id', 'Manager: ', ['class' => 'control-label'])); ?> <span
                        class="star">*</span>
                    <?php if(count($employes)): ?>
                        <?php echo e(Form::select('manager_id', array_replace(['' => 'Select'], $employes), null, ['class' => 'form-control', 'id' => 'manager_id'])); ?>

                    <?php else: ?>
                        <?php echo e(Form::select('manager_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'manager_id'])); ?>

                    <?php endif; ?>
                    <label class="help-block error"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('maximum_amount', 'Maximum amount: ', ['class' => 'control-label'])); ?> <span
                        class="star">*</span>
                    <?php echo e(Form::text('maximum_amount', null, ['id' => 'maximum_amount', 'class' => 'form-control', 'maxlength' => '100'])); ?>

                    <label class="help-block error"></label>
                </div>
            </div>

        </div>



        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?php echo e(Form::submit($submitButtonText, ['class' => 'btn btn-primary'])); ?>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <a href="<?php echo e(route('rounting.index')); ?>" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/finance/resources/views/admin/rounting/formElements.blade.php ENDPATH**/ ?>