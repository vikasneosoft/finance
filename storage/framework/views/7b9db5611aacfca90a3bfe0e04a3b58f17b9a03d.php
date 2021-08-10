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



                    </div>


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('employee.dashboard')); ?>"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>

                            <li class="breadcrumb-item active">All Expenses</li>
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
                                                        <th>Fin Year</th>
                                                        <th>Type</th>
                                                        <th class="right-side-text">ExpenseId</th>
                                                        
                                                        <th class="right-side-text">Budget</th>
                                                        <th class="right-side-text">Expense</th>
                                                        <th class="right-side-text">Balance</th>
                                                        <th>Creator</th>
                                                        <th>Status</th>
                                                        <th>View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

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

            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "<?php echo e(route('expenses.all_expenses')); ?>",
                    columns: [{
                            data: 'financialYear',
                            name: 'financialYear'
                        },
                        {
                            data: 'expenseType',
                            name: 'expenseType'
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },


                        /* {
                            data: 'project_in_charge',
                            name: 'project_in_charge'
                        }, */
                        {
                            data: 'budgetAmount',
                            name: 'budgetAmount'
                        },
                        {
                            data: 'expensesSum',
                            name: 'expensesSum'
                        },
                        {
                            data: 'balance',
                            name: 'balance'
                        },
                        {
                            data: 'employee',
                            name: 'employee'
                        },
                        {
                            data: 'isApproved',
                            name: 'isApproved',
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ],
                    columnDefs: [ {
                    targets: [2,3,4,5],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'right');
                    }
                    } ],
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                        if (aData['is_approved'] == 0 && aData['is_sumitted']==0) {

                            $('td', nRow).css('background-color', '#00000');
                        } else if (aData['is_approved'] == 0) {

                            $('td', nRow).css('background-color', '#F0E68C');
                        } else if (aData['is_approved'] == 1){

                            $('td', nRow).css('background-color', '#90EE90');
                        } else {
                            console.log('4')
                            $('td', nRow).css('background-color', '#CD5C5C');
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/submited-expenses/all-expenses.blade.php ENDPATH**/ ?>