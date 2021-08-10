<table class="table table-sm table-striped">
    <thead class="thead-color">
        <tr>
            <th>Budget For</th>
            
            <th class="right-side-text">Quantity</th>
            <th class="right-side-text">Rate</th>
            <th class="right-side-text">Budget AMT</th>
            <th>Category</th>
            <th>Sub Category</th>
           
            <th>More Detail</th>
            <th>Fileupload</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $budgetDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="tr-<?php echo e($value['id']); ?>">
                <td><?php echo e($value['budget_for']); ?></td>
                
                <td class="right-side-text"><?php echo e($value['budget_quantity']); ?> </td>
                <td class="right-side-text"><?php echo e(IND_money_format($value['budget_rate'])); ?> </td>
                <td class="right-side-text"> <?php echo e(IND_money_format($value['budget_amount'])); ?> </td>
                <td><?php echo e($value['budget_category']['name']); ?></td>
                <td><?php echo e($value['budget_subcategory']['name']); ?></td>
                
                <td><a id="more-detail" data-explanation="<?php echo e($value['budget_explanation']); ?>" data-specification="<?php echo e($value['specifications']); ?>" href="#">Click </a></td>
                <td>
                    <?php if(!empty($value['image'])): ?>
                        <a target="_blank" href="<?php echo e(URL::asset('/public/budget_images/' . $value['image'])); ?>">View
                            File</a>
                    <?php else: ?>
                        --
                    <?php endif; ?>
                </td>
                <td><a href="#" data-id="<?php echo e($value['id']); ?>" class="edit-detail"><i class="far fa-edit"
                            style="font-size: 20px;"></i></a>
                    <a href="#" data-id="<?php echo e($value['id']); ?>" class="delete-detail"><i class="fas fa-trash-alt"
                            style="font-size: 20px;"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/finance/resources/views/employee/budget/ajax/after-add.blade.php ENDPATH**/ ?>