<?php $__env->startSection('title'); ?>
    Manage Rountings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin-content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Rountings</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i
                                        class="fa fa-dashboard"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item active">Rountings</li>
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
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="<?php echo e(route('rounting.create')); ?>" class="btn btn-block btn-primary">Add</a>
                                </h3>
                            </div>

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
                                                class="table table-bordered table-striped dataTable dtr-inline yajra-datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">Sr No.</th>
                                                        <th>Employee</th>
                                                        <th>Manager</th>
                                                        <th>Level</th>
                                                        <th>Maximum Approved Amount</th>
                                                        <th>Action</th>
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
<?php $__env->startSection('admin-js'); ?>
    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(function() {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "<?php echo e(route('rounting.index')); ?>",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            render: function(data, type, row) {
                                console.log(data)
                                return '#' + data
                            }
                        },
                        {
                            data: 'employee',
                            name: 'employee'
                        },
                        {
                            data: 'manager',
                            name: 'manager'
                        },
                        {
                            data: 'level',
                            name: 'level'
                        },
                        {
                            data: 'maximum_amount',
                            name: 'maximum_amount'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            });

            /** Delete **/
            $(document).on("click", ".delete", function() {
                let id = $(this).attr('data-id');

                bootbox.confirm("Are you sure you want to delete?", function(result) {
                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('rounting.destroy', '+id+')); ?>",
                            type: "DELETE",
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
                            success: function(data) {
                                location.reload();
                            },
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/admin/rounting/listing.blade.php ENDPATH**/ ?>