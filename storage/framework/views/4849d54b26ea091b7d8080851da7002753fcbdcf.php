<?php $__env->startSection('title'); ?>
Expense for approval
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-content'); ?>
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Expense for approval</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('employee.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('expenses.get_submited_expenses')); ?>">Expenses</a>
                            </li>
                            <li class="breadcrumb-item active">Expense Detail</li>
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
                            <div class="thead-color card-header">
                                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3 class="card-title">Header Information</h3>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Financial year: </th>
                                    <td><?php echo e($expense['financial_year']['year']); ?></td>
                                </tr>
                                <tr>
                                    <th>Expense type: </th>
                                    <td><?php echo e($expense['budget_type']['name']); ?></td>
                                </tr>

                                <tr>
                                    <th> Cost Cnter: </th>
                                    <td><?php echo e($expense['cost_center']['name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Vendor: </th>
                                    <td><?php echo e($expense['vendor']); ?></td>
                                </tr>
                                <tr>
                                    <th>Vendor Contacts: </th>
                                    <td><?php echo e($expense['vendor_contacts']); ?></td>
                                </tr>
                                <tr>
                                    <th>Reason for selecting vendor: </th>
                                    <td><?php echo e($expense['reason_for_selecting_vendor']); ?></td>
                                </tr>
                                <tr>
                                    <th>Expense code: </th>
                                    <td><?php echo e($expense['expensive_code']); ?></td>
                                </tr>
                                <tr>
                                    <th>Services are required at: </th>
                                    <td><?php echo e($expense['location_id']); ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th> Project Codes: </th>
                                    <td><?php echo e($expense['project_code']['code']); ?></td>
                                </tr>
                                <tr>
                                    <th>Project ref no: </th>
                                    <td><?php echo e($expense['proj_ref_no']); ?></td>
                                </tr>

                                <tr>
                                    <th> Project Incharge: </th>
                                    <td><?php echo e($expense['project_in_charge']); ?></td>
                                </tr>
                                <tr>
                                    <th>Payment terms: </th>
                                    <td><?php echo e($expense['payment_terms']); ?></td>
                                </tr>
                                <tr>
                                    <th>Assumptions or inclusions: </th>
                                    <td><?php echo e($expense['assumptions_or_inclusions']); ?></td>
                                </tr>
                                <tr>
                                    <th>Exceptions or exclusions: </th>
                                    <td><?php echo e($expense['exceptions_or_exclusions']); ?></td>
                                </tr>
                                <tr>
                                    <th>Scope of work: </th>
                                    <td><?php echo e($expense['scope_of_work']); ?></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Warranty guarantee details: </th>
                                    <td><?php echo e($expense['warranty_guarantee_details']); ?></td>
                                </tr>
                                <tr>
                                    <th>What is required: </th>
                                    <td><?php echo e($expense['what_is_required']); ?></td>
                                </tr>
                                <tr>
                                    <th>Why is it required: </th>
                                    <td><?php echo e($expense['why_required']); ?></td>
                                </tr>
                                <tr>
                                    <th>What will change: </th>
                                    <td><?php echo e($expense['what_will_change']); ?></td>
                                </tr>
                                <tr>
                                    <th>Start date: </th>
                                    <td><?php echo e(Carbon\Carbon::parse($expense['from_date'])->format('d-m-Y')); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th> End date: </th>
                                    <td><?php echo e(Carbon\Carbon::parse($expense['to_date'])->format('d-m-Y')); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 table-responsive">
                        <table id="load-table" class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th class="right-side-text">Budget</th>
                                    <th class="right-side-text">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $expense['expense_detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key==0): ?>
                                <tr>
                                    <td class="right-side-text"><?php echo e(IND_money_format($value['budget_amt'])); ?> </td>

                                        <td class="right-side-text"><?php echo e(IND_money_format($value['expense_balance'])); ?> </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="load-table" class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th>Expense For</th>
                                    
                                    <th class="right-side-text">Quantity</th>
                                    <th class="right-side-text">Rate</th>
                                    <th class="right-side-text">Submission</th>
                                    <th class="right-side-text">Bud Amt</th>
                                   
                                    <th class="right-side-text">Balance</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    
                                    <th>Detail</th>
                                    <th>Fileupload</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $total = 0; ?>
                                <?php $__currentLoopData = $expense['expense_detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $total+= $value['expensive_amount'] ?>
                                    <tr class="tr-<?php echo e($value['id']); ?>">
                                        <td><?php echo e($value['expensive_for']); ?></td>
                                        
                                        <td class="right-side-text"><?php echo e($value['expensive_quantity']); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['expensive_rate'])); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['expensive_amount'])); ?> </td>
                                        
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['budget_amount'])); ?> </td>
                                        
                                        
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['budget_amount']-$value['expensive_amount'])); ?> </td>
                                        <td><?php echo e($value['category_name']); ?></td>
                                        <td><?php echo e($value['subcategory_name']); ?></td>
                                        
                                        <td><a id="more-detail" data-explanation="<?php echo e($value['expensive_explanation']); ?>" data-specification="<?php echo e($value['specifications']); ?>" href="#">Click </a></td>
                                        <td>
                                            <?php if(isset($value['image'])): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::asset('/public/budget_images/' . $value['image'])); ?>">View File</a>
                                            <?php else: ?>
                                            --
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $expense['pending_level']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr <?php if($value['approval_status']==2): ?> style="background-color: rgb(220, 53, 69);" <?php endif; ?>>
                                        <td><?php echo e($value['level']); ?> </td>
                                        <td>
                                            <?php if($value['approval_status']==0): ?>
                                            Pending from   -- <?php echo e($value['name']); ?>

                                            <?php elseif($value['approval_status']==1): ?>
                                                Approved by <?php echo e($value['name']); ?>

                                            <?php else: ?>
                                            Rejected by <?php echo e($value['name']); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isset($value['reason'])): ?>
                                            <?php echo e($value['reason']); ?>

                                            <?php else: ?>
                                            --
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($value['approval_status']!=0): ?>
                                            <?php echo e(Carbon\Carbon::parse($expense['created_at'])->format('d-m-Y')); ?>

                                            <?php else: ?>
                                            --
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>

<input type="hidden" id="approve-expense-route" value=<?php echo e(route('expenses.approve_expense')); ?> />
<input type="hidden" id="clone-expense-route" value=<?php echo e(route('expenses.clone_expense')); ?> />
<?php echo $__env->make('employee.submited-expenses.expense-child-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-js'); ?>
    <script src="<?php echo e(asset('public/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootstrap-datetimepicker.js')); ?>"></script>

    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/expensive.js')); ?>"></script>
    <script>
        $(document).ready(function () {

            $(document).on( "click", "#more-detail", function (e) {
                e.preventDefault();
                let explanation = $(this).attr('data-explanation');
                let specification = $(this).attr('data-specification');

                $(".modal-body #explanation").html(explanation);
                $(".modal-body #specification").html(specification);
                $('#myModal').modal('show');

            })


        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/expensive/submitted-expense-detail.blade.php ENDPATH**/ ?>