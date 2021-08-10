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
<?php /**PATH /var/www/html/finance/resources/views/employee/expensive/ajax/budget-detail-after-add.blade.php ENDPATH**/ ?>