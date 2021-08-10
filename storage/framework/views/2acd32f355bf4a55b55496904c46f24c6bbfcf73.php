<?php $__env->startSection('title'); ?>
    Approve Expenses
<?php $__env->stopSection(); ?>

<?php $__env->startSection('employee-content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">


                </div>
                <div class="row">

                    <div class="col-sm-8">

                        <div class="col-sm-8">
                            <h3>Approval Levels</h3>
                        </div>

                    </div>


                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.dashboard')); ?>"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>

                            <li class="breadcrumb-item active">Approval Levels</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if(session()->has('message')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session()->get('message')); ?>

                                    </div>
                                <?php endif; ?>
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered table-sm table-striped yajra-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Level</th>
                                                        <th>Employee</th>
                                                        <th class="right-side-text">Max Approve Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                        <?php $__currentLoopData = $routings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($value['level']); ?></td>
                                                                <td><?php echo e($value['manager']['name']); ?></td>
                                                                <td><?php echo e(IND_money_format($value['maximum_amount'])); ?></td>

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
            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    columnDefs: [ {
                    targets: [2],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/routings/listing.blade.php ENDPATH**/ ?>