<?php $__env->startSection('title'); ?>
    Manage Expenses
<?php $__env->stopSection(); ?>

<?php $__env->startSection('employee-content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">


                </div>
                <div class="row">

                    <div class="col-sm-6">

                        <a href="<?php echo e(route('budget.get_budgets')); ?>" title="Add Budget"><i class="fas fa-backward"
                                style="font-size: 20px;"></i></a>

                    </div>


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.dashboard')); ?>"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('budget.get_budgets')); ?>"><i
                                        class="fa fa-dashboard"></i>
                                    Budgets</a></li>
                            <li class="breadcrumb-item active">Expenses</li>
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
                                                class="table x-table-responsive table-sm table-bordered table-striped yajra-datatable">
                                                <thead class="thead-color">
                                                    <tr role="row">
                                                        <th>Exp#</th>
                                                        <th>Type</th>
                                                        <th>CostCenter</th>
                                                        <th>Proj.Code</th>
                                                        <th>Incharge</th>
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                        <th>Creator</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php if(!empty($expenses)): ?>
                                                        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($value['id']); ?></td>
                                                                <td><?php echo e($value['budget_type']['name']); ?></td>
                                                                <td><?php echo e($value['cost_center']['name']); ?></td>
                                                                <td><?php echo e($value['project_code']['code']); ?></td>
                                                                <td><?php echo e($value['project_in_charge']); ?></td>
                                                                <td class="right-side-text">
                                                                    <?php if(isset($value['budget_sum']['budget_amount'])): ?>
                                                                        <?php echo e(IND_money_format($value['budget_sum']['budget_amount'])); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="right-side-text">
                                                                    <?php if(isset($value['expenses_sum']['expensive_amount'])): ?>
                                                                        <?php echo e(IND_money_format($value['expenses_sum']['expensive_amount'])); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?php echo e($value['employee']['name']); ?>

                                                                <td><?php echo e(Carbon\Carbon::parse($value['created_at'])->format('d-m-Y')); ?>

                                                                </td>
                                                                <td>

                                                                    <a
                                                                        href="<?php echo e(route('expenses.view_to_edit_expenses', ['id' => $value['id']])); ?>"><i
                                                                            class="far <?php if($value['submited']==0): ?> fa-edit <?php else: ?> fa-eye <?php endif; ?>" style="font-size: 20px;"></i></a>

                                                                    <?php if(in_array($value['employee_id'], findUserOfSameLevel())): ?>

                                                                        <?php if($value['submited'] == 0): ?>
                                                                            <a href="#" data-id=<?php echo e($value['id']); ?>

                                                                                class="delete-expenses"><i
                                                                                    class="fas fa-trash-alt"
                                                                                    style="font-size: 20px;"></i></a>
                                                                        <?php endif; ?>
                                                                        <?php if(isset($value['expenses_sum']['expensive_amount'])): ?>
                                                                            <?php if($value['submited'] == 0): ?>
                                                                                <a href="#" title="Submit for approval" data-budgetId=<?php echo e($value['budget_id']); ?> data-expense=<?php echo e($expenseAmount); ?> data-budget=<?php echo e($value['budget_sum']['budget_amount']); ?>

                                                                                    data-expense-amount=<?php echo e($value['expenses_sum']['expensive_amount']); ?>

                                                                                    data-id=<?php echo e($value['id']); ?>

                                                                                    class="submit-for-approval"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                <?php if($value['is_approved'] == 0): ?>
                                                                                    Submitted for approval
                                                                                <?php elseif($value['is_approved'] == 1): ?>
                                                                                    Approved
                                                                                <?php else: ?>
                                                                                    Rejected
                                                                                <?php endif; ?>

                                                                            <?php endif; ?>
                                                                        <?php endif; ?>

                                                                    <?php endif; ?>


                                                                </td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
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

    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.yajra-datatable').DataTable();
            /** Delete **/

            $(document).on("click", ".delete-expenses", function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                bootbox.confirm("Are you sure you want to delete?", function(result) {
                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('expensive.delete')); ?>",
                            type: "post",
                            data: {
                                id: id,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#loadingImage").css({
                                    "display": "block"
                                });
                            },
                            success: function(response) {
                                location.reload()
                            },
                        });
                    }
                });
            })

            $(document).on("click", ".submit-for-approval", function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let budgetId = $(this).attr('data-budgetId');
                let expenseAmount = $(this).attr('data-expense-amount');
                let submittedAExpenseAmount = parseFloat($(this).attr('data-expense'));
                let budgetAmount = parseFloat($(this).attr('data-budget'));
                if(submittedAExpenseAmount>budgetAmount){
                    bootbox.confirm({
                            message: "Budget is less, expense is more, do you still submit the expense ?",
                            buttons: {
                                confirm: {
                                    label: 'Yes',
                                    className: 'btn-success'
                                },
                                cancel: {
                                    label: 'No',
                                    className: 'btn-danger'
                                }
                            },
                            callback: function (result) {
                                if (result) {
                                    $.ajax({
                                    url: "<?php echo e(route('expenses.submit_expenses')); ?>",
                                    type: "POST",
                                    data: {
                                        id: id,
                                        budgetId:budgetId,
                                        expense_amount: expenseAmount
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    beforeSend: function() {
                                        $("#loadingImage").css({
                                            "display": "block"
                                        });
                                    },
                                    success: function(response) {
                                        location.reload();
                                    },
                                });
                                }
                            }
                        });
                }else{
                    $.ajax({
                            url: "<?php echo e(route('expenses.submit_expenses')); ?>",
                            type: "POST",
                            data: {
                                id: id,
                                budgetId:budgetId,
                                expense_amount: expenseAmount
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#loadingImage").css({
                                    "display": "block"
                                });
                            },
                            success: function(response) {
                                location.reload();
                            },
                        });
                }


            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/expensive/listing.blade.php ENDPATH**/ ?>