<?php $__env->startSection('title'); ?>
    Add Expenses
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-css'); ?>
    <link href="<?php echo e(asset('public/css/bootstrap-datetimepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Expenses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('employee.dashboard')); ?>">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active">Add Expensive</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div id="header-form" class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Header Information
                                </h3>
                            </div>
                            <?php echo e(Form::open(['method' => 'POST', 'id' => 'add-expensive-form'])); ?>

                            <input type="hidden" value=<?php echo e($budget->id); ?> name="budget_id" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('financial_year', 'Financial year: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php if(count($fincialYears)): ?>
                                                <?php echo e(Form::select('financial_year_name', array_replace(['' => 'Select'], $fincialYears), $budget->financial_year, ['class' => 'form-control', 'disabled' => true])); ?>

                                                <?php echo e(Form::hidden('financial_year', $budget->financial_year)); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('financial_year', ['' => 'No Record'], null, ['class' => 'form-control'])); ?>

                                            <?php endif; ?>
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <?php echo e(Form::label('project_code_id', 'Project Codes: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php if(count($projectCodes)): ?>
                                                <?php echo e(Form::select('project_code_id_read', array_replace(['' => 'Select'], $projectCodes), $budget->project_code_id, ['class' => 'form-control', 'disabled' => true])); ?>

                                                <?php echo e(Form::hidden('project_code_id', $budget->project_code_id)); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('project_code_id', ['' => 'No Record'], null, ['class' => 'form-control'])); ?>

                                            <?php endif; ?>
                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('budget_type_id', 'Expense type : ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php if(count($budgetTypes)): ?>
                                                <?php echo e(Form::select('budget_type_id_read', array_replace(['' => 'Select'], $budgetTypes), $budget->budget_type_id, ['class' => 'form-control', 'disabled' => true])); ?>

                                                <?php echo e(Form::hidden('budget_type_id', $budget->budget_type_id)); ?>


                                            <?php else: ?>
                                                <?php echo e(Form::select('budget_type_id_read', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id'])); ?>

                                            <?php endif; ?>
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('budget_proj_ref_no', 'Project ref no: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('proj_ref_no', $budget->budget_proj_ref_no, ['id' => 'proj_ref_no', 'class' => 'form-control', 'readonly' => 'true'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('cost_center_id', 'Cost Cnter: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php if(count($costCenters)): ?>
                                                <?php echo e(Form::select('cost_center_id_read', array_replace(['' => 'Select'], $costCenters), $budget->cost_center_id, ['class' => 'form-control', 'disabled' => true])); ?>

                                                <?php echo e(Form::hidden('cost_center_id', $budget->cost_center_id)); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('cost_center_id_read', ['' => 'No Record'], null, ['class' => 'form-control'])); ?>

                                            <?php endif; ?>
                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <?php echo e(Form::label('project_in_charge', 'Project Incharge: ', ['class' => 'control-label'])); ?><span
                                                class="star">*</span>
                                            <?php echo e(Form::text('project_in_charge', $budget->project_in_charge, ['id' => 'project_in_charge', 'class' => 'form-control', 'readonly' => 'true'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('expensive_code', 'Budget code: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('expensive_code', $budget->budget_code, ['id' => 'expensive_code', 'class' => 'form-control', 'readonly' => 'true'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('from_date', 'Start date: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <input type="text"
                                                value="<?php echo e(Carbon\Carbon::parse($budget->budget_from_date)->format('d-m-Y')); ?>"
                                                id="from_date" class="form-control" name="from_date" readonly="true" />
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('to_date', 'End date: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <input type="text"
                                                value="<?php echo e(Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y')); ?>"
                                                id="to_date" class="form-control" name="to_date" readonly="true" />

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('vendor', 'Vendor: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <?php echo e(Form::text('vendor', $budget->vendor, ['id' => 'vendor', 'class' => 'form-control', 'readonly' => 'true'])); ?>


                                        <label class="d-none help-block error"></label>
                                    </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('what_is_required', 'What is required: ', ['class' => 'control-label'])); ?>


                                            <?php echo e(Form::text('what_is_required', null, ['id' => 'what_is_required', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('vendor_contacts', 'Vendor Contacts: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php echo e(Form::text('vendor_contacts', $budget->vendor_contacts, ['id' => 'vendor_contacts', 'class' => 'form-control', 'readonly' => 'true'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('why_required', 'Why is it required: ', ['class' => 'control-label'])); ?>

                                                <?php echo e(Form::text('why_required', null, ['id' => 'why_required', 'class' => 'form-control'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('reason_for_selecting_vendor', 'Reason for selecting vendor: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('reason_for_selecting_vendor', null, ['id' => 'reason_for_selecting_vendor', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('warranty_guarantee_details', 'Warranty guarantee details: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('warranty_guarantee_details', null, ['id' => 'warranty_guarantee_details', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('payment_terms', 'Payment terms: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('payment_terms', null, ['id' => 'payment_terms', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('scope_of_work', 'Scope of work: ', ['class' => 'control-label'])); ?>

                                            <?php echo e(Form::text('scope_of_work', null, ['id' => 'scope_of_work', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('assumptions_or_inclusions', 'Assumptions or inclusions: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('assumptions_or_inclusions', null, ['id' => 'assumptions_or_inclusions', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('what_will_change', 'What will change: ', ['class' => 'control-label'])); ?>

                                            <?php echo e(Form::text('what_will_change', null, ['id' => 'what_will_change', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('exceptions_or_exclusions', 'Exceptions or exclusions: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('exceptions_or_exclusions', null, ['id' => 'exceptions_or_exclusions', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('location_id', 'Services are required at: ', ['class' => 'control-label'])); ?>

                                            <?php if(count($locations)): ?>
                                                <?php echo e(Form::select('location_id', array_replace(['' => 'Select'], $locations), null, ['class' => 'form-control', 'id' => 'location_id'])); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('location_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'location_id'])); ?>

                                            <?php endif; ?>
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <?php echo e(Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save-btn'])); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <a href="<?php echo e(route('budget.get_budgets')); ?>"
                                                class="btn btn-default float-center">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="#"
                                                class="d-none delete-expenses btn btn-danger float-center">Delete</a>
                                            <a href="#" class="d-none x-load-form-element btn btn-success float-center">Add
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
                <div style="display:none" id="budget-detail-div" class="row">
                    <h2>Budget Detail</h2>
                    <div class="col-12 table-responsive">
                        <table class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th>Bud For</th>
                                    <th class="right-side-text">Bud Qty</th>
                                    <th class="right-side-text">Rate</th>
                                    <th class="right-side-text">Bud Amt</th>

                                    <th class="right-side-text">Sub Qty</th>
                                    <th class="right-side-text">Exp Amt</th>
                                    <th class="right-side-text">Sub Amt</th>
                                    <th class="right-side-text">Balance</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $expenseDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="tr-<?php echo e($value['id']); ?>">
                                        <td><?php echo e($value['budget_for']); ?></td>
                                        <td class="right-side-text"><?php echo e($value['budget_quantity']); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['budget_rate'])); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['budget_amount'])); ?> </td>

                                        <td class="right-side-text"><?php if(isset($value['expense_quantity'])): ?>
                                            <?php echo e($value['expense_quantity']); ?>

                                            <?php else: ?>
                                            --
                                            <?php endif; ?>
                                        </td>
                                        <td class="right-side-text">
                                            <?php if(isset($budget['expenseDetail'][$key]['amount'])): ?>
                                            <?php echo e($budget['expenseDetail'][$key]['amount']-$value['expense_amount']); ?>

                                            <?php else: ?>
                                            0
                                            <?php endif; ?>

                                        </td>
                                        <td class="right-side-text">
                                            <?php if(isset($value['expense_amount'])): ?>
                                            <?php echo e(IND_money_format($value['expense_amount'])); ?>

                                            <?php else: ?>
                                            --
                                            <?php endif; ?>

                                        </td>

                                        <td class="right-side-text"><?php if(isset($value['balance'])): ?>
                                            <?php echo e(IND_money_format($value['balance'])); ?>


                                            <?php else: ?>
                                            --
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($value['cat_name']); ?></td>
                                        <td><?php echo e($value['sub_cat_name']); ?></td>
                                        <td>
                                            <a href="#" data-balance=<?php if(isset($value['balance'])): ?><?php echo e($value['balance']); ?> <?php else: ?> 1 <?php endif; ?> data-id="<?php echo e($value['id']); ?>" class="load-form-element">Add Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div style="display:none" id="expense-detail-div" class="row">
                    <h2>Expense Detail</h2>
                    <div class="col-12 table-responsive">
                        <table id="load-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Budget For</th>
                                    <th>Specifications</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Exp AMT</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Justification or Detailing</th>
                                    <th>Fileupload</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div id="form-elements" class="xx-row"></div>
            </div>

        </section>
        <input type="hidden" id="return-back-route" value=<?php echo e(route('budget.index')); ?> />
        <input type="hidden" id="add-expensive-route" value=<?php echo e(route('expensive.add_expensive')); ?> />
        <input type="hidden" id="load-expensive-detail-form-route"
            value=<?php echo e(route('expensive.view_add_expensive_detail')); ?> />
        <input type="hidden" id="add-expensive-detail-route" value=<?php echo e(route('expensive.add_expensive_detail')); ?> />
        <input type="hidden" id="expensive-detail-edit-view-route"
            value=<?php echo e(route('expensive_detail.expensive_detail_edit_view')); ?> />
        <input type="hidden" id="expensive-detail-update"
            value=<?php echo e(route('expensive_detail.update_expensive_detail')); ?> />
        <input type="hidden" id="expensive-id" value="0" />
        <input type="hidden" id="budget-id" value="<?php echo e($budget->id); ?>" />
        <input type="hidden" id="get-budget-category-route" value=<?php echo e(route('common.get_subcategory')); ?> />
        <input type="hidden" id="expensive-delete-route" value=<?php echo e(route('expensive.delete')); ?> />
        <input type="hidden" id="expensive-detail-delete-route" value=<?php echo e(route('expensive_detail.delete')); ?> />

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-js'); ?>
    <script src="<?php echo e(asset('public/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/additional-methods.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/expensive.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/expensive/add.blade.php ENDPATH**/ ?>