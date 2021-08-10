<?php echo $__env->make('employee.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-content-wrapper">
    <div class="page-content">
        <?php echo $__env->yieldContent('employee-content'); ?>
    </div>
</div>
<?php echo $__env->make('employee.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/finance/resources/views/employee/layout.blade.php ENDPATH**/ ?>