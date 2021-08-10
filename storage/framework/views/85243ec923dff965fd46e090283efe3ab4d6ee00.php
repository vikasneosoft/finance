<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-content'); ?>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.dashboard')); ?>">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <h4>Type Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-sm table-bordered">
                                                <thead class="thead-color">
                                                  <tr>
                                                    <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $typeStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($value['year']); ?></td>
                                                            <td><?php echo e($value['type']); ?></td>
                                                            <td style="text-align: right;"><?php echo e(IND_money_format($value['budget_amount'])); ?></td>
                                                            <td style="text-align: right;"><?php echo e(IND_money_format($value['expense_amount'])); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                              </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <h4>Category Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-sm table-bordered">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th>Category</th>

                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $__currentLoopData = $categoryStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($value['year']); ?></td>
                                                            <td><?php echo e($value['type']); ?></td>
                                                            <td><?php echo e($value['cat_name']); ?></td>

                                                            <td style="text-align: right;"> <?php echo e(IND_money_format($value['budget_amount'])); ?></td>

                                                            <td style="text-align: right;">

                                                                <?php echo e(IND_money_format($value['expense_amount'])); ?>


                                                            </td>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <h4>Category Subcategory Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table x-table-responsive table-sm table-bordered table-striped category-subcategory-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th>Category</th>
                                                        <th>SubCategory</th>
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $__currentLoopData = $catSubCatStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($value['year']); ?></td>
                                                            <td><?php echo e($value['type']); ?></td>
                                                            <td><?php echo e($value['cat_name']); ?></td>
                                                            <td><?php echo e($value['sub_cat_name']); ?></td>
                                                            <td><?php echo e(IND_money_format($value['budget_amount'])); ?></td>

                                                            <td>

                                                                <?php echo e(IND_money_format($value['expense_amount'])); ?>


                                                            </td>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-js'); ?>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.category-subcategory-datatable').DataTable({
                    columnDefs: [ {
                    targets: [4,5],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/dashboard.blade.php ENDPATH**/ ?>