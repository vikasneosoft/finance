<?php $__env->startSection('title'); ?>
    Add Rounting
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin-css'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin-content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"> Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Rounting</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rounting</h3>
                        </div>
                        <?php if(session()->has('error')): ?>
                            <div class="alert alert-danger danger-message">
                                <?php echo e(session()->get('error')); ?>

                            </div>
                        <?php endif; ?>
                        <?php echo e(Form::open(['method' => 'POST', 'id' => 'add-form'])); ?>

                        <?php echo $__env->make('admin.rounting.formElements',['submitButtonText' => 'Add'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin-js'); ?>
    <script src="<?php echo e(asset('public/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/additional-methods.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {

            (function($) {
                $.fn.inputFilter = function(inputFilter) {
                    return this.on("input keydown keyup mousedown mouseup select contextmenu drop",
                        function() {
                            if (inputFilter(this.value)) {
                                this.oldValue = this.value;
                                this.oldSelectionStart = this.selectionStart;
                                this.oldSelectionEnd = this.selectionEnd;
                            } else if (this.hasOwnProperty("oldValue")) {
                                this.value = this.oldValue;
                                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                            } else {
                                this.value = "";
                            }
                        });
                };
            })(jQuery);
            // Install input filters.

            $("#maximum_amount").inputFilter(function(value) {
                return /^-?\d*[.,]?\d*$/.test(value);
            });

            $('#company_id').change(function() {
                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    data: {
                        'companyId': $(this).val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "<?php echo e(route('common.get_divisions_locations_by_company')); ?>",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        $("#section_id").html('<option value="">--Select--</option>');
                        $("#department_id").html('<option value="">--Select--</option>');
                        var divisions = '<option value="">--Select--</option>';
                        var locations = '<option value="">--Select--</option>';


                        if (response.divisions) {
                            $.each(response.divisions, function(key, value) {
                                divisions +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            $('#division_id').html(divisions);
                        } else {
                            $("#division_id").html('');
                        }
                        if (response.locations) {
                            $.each(response.locations, function(key, value) {
                                locations +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            $('#location_id').html(locations);
                        } else {
                            $("#location_id").html('');
                        }
                    }
                });
            });

            $('#division_id').change(function() {
                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    data: {
                        'divisionId': $(this).val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "<?php echo e(route('common.get_departments_by_division')); ?>",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        $("#section_id").html('<option value="">--Select--</option>');
                        var departments = '<option value="">--Select--</option>';

                        if (response.departments) {
                            $.each(response.departments, function(key, value) {
                                departments +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            $('#department_id').html(departments);
                        } else {
                            $("#department_id").html('');
                        }
                    }
                });
            });

            $('#department_id').change(function() {
                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    data: {
                        'departmentId': $(this).val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "<?php echo e(route('common.get_sections_by_department')); ?>",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        var sections = '<option value="">--Select--</option>';

                        if (response.sections) {
                            $.each(response.sections, function(key, value) {
                                sections +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            $('#section_id').html(sections);
                        } else {
                            $("#section_id").html('');
                        }
                    }
                });
            });

            $("#add-form").validate({
                rules: {
                    employee_id: {
                        required: true
                    },
                    manager_id: {
                        required: true,
                    },
                    level: {
                        required: true,
                    },
                    maximum_amount: {
                        required: true,
                        number: true
                    }

                },
                messages: {
                    employee_id: {
                        required: "Select employee"
                    },
                    manager_id: {
                        required: "Select manager"
                    },
                    level: {
                        required: "Select level",
                    },
                    maximum_amount: {
                        required: "Maximum amount field is required",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#add-form').serialize(),
                        url: "<?php echo e(route('rounting.store')); ?>",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(data) {
                            window.location.href =
                                "<?php echo e(route('rounting.index')); ?>";
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $("#loadingImage").css({
                                "display": "none"
                            });
                            $.each(xhr.responseJSON.errors, function(i, obj) {
                                $('input[name="' + i + '"]').closest('.form-group')
                                    .addClass('has-error');
                                $('input[name="' + i + '"]').closest('.form-group')
                                    .find('label.help-block').slideDown(400).html(
                                        obj);
                                $('select[name="' + i + '"]').closest('.form-group')
                                    .addClass('has-error');
                                $('select[name="' + i + '"]').closest('.form-group')
                                    .find('label.help-block').slideDown(400).html(
                                        obj);
                            });
                        }
                    });
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/admin/rounting/add.blade.php ENDPATH**/ ?>