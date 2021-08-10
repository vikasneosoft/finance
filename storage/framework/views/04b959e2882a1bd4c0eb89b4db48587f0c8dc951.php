<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Details</h3>
                    </div>
                    <?php echo e(Form::open(['id' => 'add-form', 'file' => true])); ?>


                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('expensive_for', 'Expense for: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <?php $expenseAmount = (isset($submittedExpenseDetail[0]['id'])) ? array_sum(array_column($submittedExpenseDetail,'expense_amount')) : 0 ;
                                        $budgetAmt = array_sum(array_column($submittedExpenseDetail,'budget_amount'));
                                        ?>
                                        <?php echo e(Form::hidden('budget_detail_id', $budgetDetail->id)); ?>

                                        <?php echo e(Form::hidden('budget_amt',$budgetAmt )); ?>

                                        <?php echo e(Form::hidden('submited_expense', $expenseAmount)); ?>

                                        <?php echo e(Form::hidden('expense_balance', $budgetAmt-$expenseAmount)); ?>

                                        <?php echo e(Form::text('expensive_for', $budgetDetail->budget_for, ['id' => 'expensive_for', 'class' => 'form-control'])); ?>

                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('expensive_quantity', 'Quantity: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <?php

                                       // $qty = (isset($submittedExpenseDetail['remain_qty'])) ? $submittedExpenseDetail['remain_qty'] : $budgetDetail->budget_quantity;




                                        ?>
                                        <?php echo e(Form::text('expensive_quantity', $budgetDetail->budget_quantity, ['id' => 'expensive_quantity', 'class' => 'form-control'])); ?>

                                        <label class="d-none help-block error"></label>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('specifications', 'Specifications: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <?php echo e(Form::text('specifications', $budgetDetail->specifications, ['id' => 'specifications', 'class' => 'form-control'])); ?>

                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('expensive_rate', 'Rate: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <?php echo e(Form::text('expensive_rate', $budgetDetail->budget_rate, ['id' => 'expensive_rate', 'class' => 'form-control'])); ?>

                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('budget_category_id', 'Category: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <?php if(count($categories)): ?>
                                            <?php echo e(Form::select('budget_category_id', array_replace(['' => 'Select'], $categories), $budgetDetail->budget_category_id, ['class' => 'form-control', 'id' => 'budget_category_id'])); ?>

                                        <?php else: ?>
                                            <?php echo e(Form::select('budget_category_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_category_id'])); ?>

                                        <?php endif; ?>
                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <?php echo e(Form::label('image', 'Image: ', ['class' => 'control-label'])); ?>

                                        <?php if(isset($budgetDetail->image)): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::asset('/public/budget_images/' . $budgetDetail->image)); ?>">View
                                                File</a>
                                            <?php echo e(Form::hidden('budget_image', $budgetDetail->image)); ?>

                                        <?php endif; ?>
                                        <?php echo e(Form::file('image', ['id' => 'image'])); ?>

                                        <label class="d-none help-block error"></label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-2 col-md-6">
                                    <div class="form-group">

                                        <?php echo e(Form::label('budget_subcategory_id', 'Subcategory: ', ['class' => 'control-label'])); ?>

                                        <span class="star">*</span>
                                        <select id="budget_subcategory_id" class="form-control"
                                            name="budget_subcategory_id">
                                            <option value="">Select</option>
                                            <?php if(isset($subcategories)): ?>
                                                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($budgetDetail->budget_subcategory_id == $value['id']): ?> selected <?php endif; ?>
                                                        value="<?php echo e($value['id']); ?>">
                                                        <?php echo e($value['name']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>


                                        <label class="d-none help-block error"></label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('expensive_explanation', 'Justification: ', ['class' => 'control-label'])); ?>


                                        <?php echo e(Form::textarea('expensive_explanation', $budgetDetail->budget_explanation, ['id' => 'expensive_explanation', 'class' => 'form-control'])); ?>

                                        <label class="d-none help-block error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::submit('Save', ['class' => 'btn btn-primary'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="#" class="cancel-btn btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /var/www/html/finance/resources/views/employee/expensive/ajax/add.blade.php ENDPATH**/ ?>