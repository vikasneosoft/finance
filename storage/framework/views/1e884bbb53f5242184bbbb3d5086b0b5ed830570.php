<?php $__env->startSection('title'); ?>
    Edit Expenses
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
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('expenses.get_expenses', $expense['budget_id'])); ?> ">Expense</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Expense</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Header Information</h3>
                                <h3 class="card-title float-right">
                                    <a href="#" class="add-detail-element"><i class="fas fa-plus"
                                            style="font-size: 20px;"></i></a> <a href="#"
                                        class="close-detail-element d-none"><i class="fas fa-minus"
                                            style="font-size: 20px;"></i></a>
                                </h3>
                            </div>
                            <div id="header-form" class="card-body">
                                <?php echo e(Form::model($expense, ['id' => 'edit-expensive-form'])); ?>

                                <?php echo e(Form::hidden('action', 'edit')); ?>

                                <?php echo e(Form::hidden('id', $expense['id'], ['id' => 'id'])); ?>

                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('financial_year', 'Financial year: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php if(count($fincialYears)): ?>
                                                <?php echo e(Form::select('financial_year', array_replace(['' => 'Select'], $fincialYears), null, ['class' => 'form-control', 'id' => 'financial_year','disabled' => true])); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('financial_year', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'financial_year','disabled' => true])); ?>

                                            <?php endif; ?>
                                            <?php echo e(Form::hidden('financial_year', $expense->financial_year)); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('project_code_id', 'Project Codes: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php if(count($projectCodes)): ?>
                                                <?php echo e(Form::select('project_code_id', array_replace(['' => 'Select'], $projectCodes), null, ['class' => 'form-control', 'id' => 'project_code_id'])); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('project_code_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'project_code_id'])); ?>

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
                                                <?php echo e(Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), null, ['class' => 'form-control', 'id' => 'budget_type_id','disabled' => true])); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('budget_type_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id'])); ?>

                                            <?php endif; ?>
                                            <?php echo e(Form::hidden('budget_type_id', $expense->budget_type_id)); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('proj_ref_no', 'Project ref no: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('proj_ref_no', null, ['id' => 'proj_ref_no', 'class' => 'form-control'])); ?>

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
                                                <?php echo e(Form::select('cost_center_id', array_replace(['' => 'Select'], $costCenters), null, ['class' => 'form-control', 'id' => 'cost_center_id','disabled' => true])); ?>

                                            <?php else: ?>
                                                <?php echo e(Form::select('cost_center_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'cost_center_id'])); ?>

                                            <?php endif; ?>
                                            <label class="d-none help-block error"></label>
                                            <?php echo e(Form::hidden('cost_center_id', $expense->cost_center_id)); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <?php echo e(Form::label('project_in_charge', 'Project Incharge: ', ['class' => 'control-label'])); ?><span
                                                class="star">*</span>
                                            <?php echo e(Form::text('project_in_charge', null, ['id' => 'project_in_charge', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('expensive_code', 'Budget code: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('expensive_code', null, ['id' => 'expensive_code', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>


                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('from_date', 'Start date: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <input type="text"
                                                value="<?php echo e(Carbon\Carbon::parse($expense->from_date)->format('d-m-Y')); ?>"
                                                id="from_date" class="form-control" name="from_date" />
                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('to_date', 'End date: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <input type="text"
                                                value="<?php echo e(Carbon\Carbon::parse($expense->to_date)->format('d-m-Y')); ?>"
                                                id="to_date" class="form-control" name="to_date" />

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('vendor', 'Vendor: ', ['class' => 'control-label'])); ?>

                                            <span class="star">*</span>
                                            <?php echo e(Form::text('vendor', null, ['id' => 'vendor', 'class' => 'form-control'])); ?>


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
                                            <?php echo e(Form::text('vendor_contacts', null, ['id' => 'vendor_contacts', 'class' => 'form-control'])); ?>

                                            <label class="d-none help-block error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('why_required', 'Why is it required: ', ['class' => 'control-label'])); ?>

                                            <?php echo e(Form::text('why_required', null, ['id' => 'warranty_guarantee_details', 'class' => 'form-control'])); ?>

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

                                <?php if(in_array($expense['employee_id'], findUserOfSameLevel())): ?>
                                    <?php if($expense['submited'] == 0): ?>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <?php echo e(Form::submit('Update', ['class' => 'btn btn-primary'])); ?>

                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <a href="<?php echo e(route('expenses.get_expenses', ['id' => $expense->budget_id])); ?>"
                                                        class="btn btn-default float-center">Back</a>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <a href="#" class="delete-expenses btn btn-danger float-center">Delete</a>

                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <a href="#" data-budgetId="<?php echo e($expense->budget_id); ?>" data-expense=<?php echo e($expenseAmount); ?> data-budget=<?php echo e(array_sum(array_column($budget->budgetDetail->toArray(), 'budget_amount'))); ?> data-id=<?php echo e($expense['id']); ?>

                                                        class="btn submit-for-approval btn-success float-center">Submit for
                                                        approval</a>
                                                        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-4">
                                            <div class="card <?php if($expense['is_approved']==0): ?>card-warning <?php elseif($expense['is_approved']==1): ?>card-success <?php else: ?> card-danger <?php endif; ?>">
                                                <div class="card-header">
                                                  <h3 class="card-title"><?php if($expense['is_approved'] == 0): ?>
                                                    Expense is submitted for approval
                                                <?php elseif($expense['is_approved']==1): ?>
                                                    Approved
                                                <?php else: ?>
                                                    Rejected
                                                <?php endif; ?></h3>
                                                </div>

                                              </div>

                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div id="budget-detail-div" style="padding: 0px 0px 0px 15px;" class="row">
                <h4>Budget Detail</h4>
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
                                        <?php echo e($budget['expenseDetail'][$key]['amount']-$value['expense_amount']); ?>

                                    </td>
                                    <td class="right-side-text">
                                        <?php if(isset($value['expense_amount'])): ?>
                                            <?php echo e(IND_money_format($value['expense_amount'])); ?>

                                        <?php else: ?>
                                        --
                                        <?php endif; ?>

                                    </td>
                                    <td class="right-side-text">
                                        <?php if(isset($value['balance'])): ?>
                                            <?php echo e(IND_money_format($value['balance'])); ?>

                                        <?php else: ?>
                                        --
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($value['cat_name']); ?></td>
                                    <td><?php echo e($value['sub_cat_name']); ?></td>
                                    <td>

                                        <?php if(in_array($expense['employee_id'], findUserOfSameLevel())): ?>
                                            <?php if($expense['submited']==0): ?>
                                                <a href="#" data-balance=<?php if(isset($value['balance'])): ?><?php echo e($value['balance']); ?> <?php else: ?> 1 <?php endif; ?> data-id="<?php echo e($value['id']); ?>" class="load-form-element">Add Detail</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div id="expense-detail-div"  style="padding: 0px 0px 0px 15px;" class="row">
                <h4>Expense Detail</h4>
                <div class="col-md-12 col-md-offset-2 table-responsive">
                    <table id="load-table" class="table table-sm table-striped">
                        <thead class="thead-color">
                            <tr>
                                <th>Exp For</th>
                                
                                <th class="right-side-text">Quantity</th>
                                <th class="right-side-text">Rate</th>
                                <th class="right-side-text">Exp Amt</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(isset($expense)): ?>
                                <?php  $total = 0 ; ?>
                                <?php $__currentLoopData = $expense->expenseDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $total+=$value['expensive_amount']; ?>
                                    <tr class="tr-<?php echo e($value['id']); ?>">
                                        <td><?php echo e($value['expensive_for']); ?></td>
                                        
                                        <td class="right-side-text"><?php echo e($value['expensive_quantity']); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['expensive_rate'])); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['expensive_amount'])); ?> </td>

                                        <td><?php echo e($value['category_name']); ?></td>
                                        <td><?php echo e($value['subcategory_name']); ?></td>
                                       
                                        <td>
                                            <?php if(in_array($expense['employee_id'], findUserOfSameLevel())): ?>
                                                <?php if($expense['submited'] == 0): ?>
                                                    <a href="#" data-id="<?php echo e($value['id']); ?>" class="edit-detail"><i
                                                            class="far fa-edit" style="font-size: 20px;"></i></a>
                                                    <a data-id="<?php echo e($value['id']); ?>" href="#" class="delete-detail"><i
                                                            class="fas fa-trash-alt" style="font-size: 20px;"></i></a>
                                                <?php else: ?>
                                                    --
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <div id="form-elements" class="xx-row">

            </div>
    </div>
    </section>

    </div>
    <input type="hidden" id="return-back-route" value=<?php echo e(route('budget.index')); ?> />
    <input type="hidden" id="update-expensive-route" value=<?php echo e(route('expensive.update_expensive')); ?> />
    <input type="hidden" id="expensive-detail-edit-view-route"
        value=<?php echo e(route('expensive_detail.expensive_detail_edit_view')); ?> />
    <input type="hidden" id="expensive-detail-update" value=<?php echo e(route('expensive_detail.update_expensive_detail')); ?> />
    <input type="hidden" id="load-expensive-detail-form-route"
        value=<?php echo e(route('expensive.view_add_expensive_detail')); ?> />
    <input type="hidden" id="add-expensive-detail-route" value=<?php echo e(route('expensive.add_expensive_detail')); ?> />
    <input type="hidden" id="expensive-id" value="<?php echo e($expense->id); ?>" />
    <input type="hidden" id="budget-id" value="<?php echo e($expense->budget_id); ?>" />

    <input type="hidden" id="get-budget-category-route" value=<?php echo e(route('common.get_subcategory')); ?> />

    <input type="hidden" id="expensive-delete-route" value=<?php echo e(route('expensive.delete')); ?> />
    <input type="hidden" id="expensive-detail-delete-route" value=<?php echo e(route('expensive_detail.delete')); ?> />

    <input type="hidden" id="expense-submit-route" value=<?php echo e(route('expenses.submit_expenses')); ?> />
    <input type="hidden" id="total-amount" value=<?php echo e($total); ?> />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-js'); ?>
    <script src="<?php echo e(asset('public/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/additional-methods.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/expensive.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/expensive/edit.blade.php ENDPATH**/ ?>