<?php $__env->startSection('title'); ?>
    Edit Budget
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-css'); ?>
    <link href="<?php echo e(asset('public/css/bootstrap-datetimepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-content'); ?>
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Budget</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('employee.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('budget.index')); ?>">Budgets</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Budget</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div id="header-form" class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Header Information
                                </h3>
                            </div>
                            <?php echo e(Form::model($budget, ['id' => 'edit-budget-form'])); ?>

                            <?php echo e(Form::hidden('action', 'edit')); ?>

                            <?php echo e(Form::hidden('id', $budget['id'], ['id' => 'id'])); ?>

                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('financial_year', 'Financial year: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php if(count($fincialYears)): ?>
                                                    <?php echo e(Form::select('financial_year', array_replace(['' => 'Select'], $fincialYears), null, ['class' => 'form-control', 'id' => 'financial_year'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::select('financial_year', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'financial_year'])); ?>

                                                <?php endif; ?>
                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('project_code_id', 'Project Codes: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php if(count($projectCodes)): ?>
                                                    <?php echo e(Form::select('project_code_id', array_replace(['' => 'Select'], $projectCodes), null, ['class' => 'form-control', 'id' => 'project_code_id'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::select('project_code_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'project_code_id'])); ?>

                                                <?php endif; ?>
                                                <label class="d-none help-block error"></label>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('budget_type_id', 'Budget type : ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php if(count($budgetTypes)): ?>
                                                    <?php echo e(Form::select('budget_type_id', array_replace(['' => 'Select'], $budgetTypes), null, ['class' => 'form-control', 'id' => 'budget_type_id'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::select('budget_type_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'budget_type_id'])); ?>

                                                <?php endif; ?>
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('budget_proj_ref_no', 'Project ref no: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php echo e(Form::text('budget_proj_ref_no', null, ['id' => 'budget_proj_ref_no', 'class' => 'form-control'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('cost_center_id', 'Cost Cnter: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php if(count($costCenters)): ?>
                                                    <?php echo e(Form::select('cost_center_id', array_replace(['' => 'Select'], $costCenters), null, ['class' => 'form-control', 'id' => 'cost_center_id'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::select('cost_center_id', ['' => 'No Record'], null, ['class' => 'form-control', 'id' => 'cost_center_id'])); ?>

                                                <?php endif; ?>
                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <?php echo e(Form::label('project_in_charge', 'Project Incharge: ', ['class' => 'control-label'])); ?><span
                                                    class="star">*</span>
                                                <?php echo e(Form::text('project_in_charge', null, ['id' => 'project_in_charge', 'class' => 'form-control'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('vendor', 'Vendor: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php echo e(Form::text('vendor', null, ['id' => 'vendor', 'class' => 'form-control'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo e(Form::label('budget_from_date', 'Start date: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <input type="text"
                                                    value="<?php echo e(Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y')); ?>"
                                                    id="budget_from_date" class="form-control" name="budget_from_date" />
                                                <label class="d-none help-block error"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo e(Form::label('budget_to_date', 'End date: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <input type="text"
                                                    value="<?php echo e(Carbon\Carbon::parse($budget->budget_to_date)->format('d-m-Y')); ?>"
                                                    id="budget_to_date" class="form-control" name="budget_to_date" />
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('vendor_contacts', 'Vendor Contacts: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php echo e(Form::text('vendor_contacts', null, ['id' => 'vendor_contacts', 'class' => 'form-control'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('budget_code', 'Budget code: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <?php echo e(Form::text('budget_code', null, ['id' => 'budget_code', 'class' => 'form-control'])); ?>

                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <?php echo e(Form::label('division_id', 'Division: ', ['class' => 'control-label'])); ?>

                                            <?php if(Auth::user()->division_id == 0): ?>
                                                <div class="form-group">

                                                    <select id="division_id" class="form-control" name="division_id">
                                                        <?php if(isset($divisions)): ?>
                                                            <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($budget->division_id == $value['id']): ?> selected <?php endif; ?>
                                                                    value="<?php echo e($value['id']); ?>">
                                                                    <?php echo e($value['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <label class="d-none help-block error"></label>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group">
                                                    <?php if(isset(userDetail()->division['name'])): ?>
                                                        <?php echo e(userDetail()->division['name']); ?>

                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('location_id', 'Location: ', ['class' => 'control-label'])); ?>

                                                <?php if(Auth::user()->location_id == 0): ?>
                                                <select id="location_id" class="form-control" name="location_id">
                                                    <?php if(isset($locations)): ?>
                                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($budget->location_id == $value['id']): ?> selected <?php endif; ?>
                                                                value="<?php echo e($value['id']); ?>">
                                                                <?php echo e($value['name']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php else: ?>
                                                <div class="form-group">
                                                <?php echo e(userDetail()->location['name']); ?>

                                                </div>
                                                <?php endif; ?>
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-offset-2 col-md-6">
                                            <?php echo e(Form::label('department_id', 'Department: ', ['class' => 'control-label'])); ?>

                                            <?php if(Auth::user()->department_id == 0): ?>

                                                <div class="form-group">

                                                    <select id="department_id" class="form-control" name="department_id">
                                                        <?php if(isset($departments)): ?>
                                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($budget->department_id == $value['id']): ?> selected <?php endif; ?>
                                                                    value="<?php echo e($value['id']); ?>">
                                                                    <?php echo e($value['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <label class="d-none help-block error"></label>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group">
                                                    <?php if(isset(userDetail()->department['name'])): ?>
                                                        <?php echo e(userDetail()->department['name']); ?>

                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <?php echo e(Form::label('section_id', 'Section: ', ['class' => 'control-label'])); ?>

                                                <span class="star">*</span>
                                                <select id="section_id" class="form-control" name="section_id">
                                                    <?php if(isset($sections)): ?>
                                                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($budget->section_id == $value['id']): ?> selected <?php endif; ?>
                                                                value="<?php echo e($value['id']); ?>">
                                                                <?php echo e($value['name']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                                <label class="d-none help-block error"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <a href="<?php echo e(route('budget.index')); ?>"
                                                    class="btn btn-default float-center">Cancel</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <a href="#"
                                                    class="d-none delete-budget btn btn-danger float-center">Delete</a>
                                                <a href="#"
                                                    class="x-d-none load-form-element btn btn-success float-center">Add
                                                    Detail</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
                <div id="budget-detail-div" class="row">
                    <div class="col-12 table-responsive">
                        <table id="load-table" class="table table-sm table-striped">
                            <thead class="thead-color">
                                <tr>
                                    <th>Budget For</th>
                                    
                                    <th class="right-side-text">Quantity</th>
                                    <th class="right-side-text"> Rate</th>
                                    <th class="right-side-text">Budget Amt</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    
                                    <th>More Detail</th>
                                    <th>Fileupload</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $budget->budgetDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="tr-<?php echo e($value['id']); ?>">
                                        <td><?php echo e($value['budget_for']); ?></td>
                                        
                                        <td class="right-side-text"><?php echo e($value['budget_quantity']); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['budget_rate'])); ?> </td>
                                        <td class="right-side-text"><?php echo e(IND_money_format($value['budget_amount'])); ?> </td>
                                        <td><?php echo e($value['category_name']); ?></td>
                                        <td><?php echo e($value['subcategory_name']); ?></td>
                                       
                                        <td><a id="more-detail" data-explanation="<?php echo e($value['budget_explanation']); ?>" data-specification="<?php echo e($value['specifications']); ?>" href="#">Click </a></td>
                                        <td>
                                            <?php if(!empty($value['image'])): ?>
                                                <a target="_blank"
                                                    href="<?php echo e(URL::asset('/public/budget_images/' . $value['image'])); ?>">View
                                                    File</a>
                                            <?php else: ?>
                                                --
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="#" data-id="<?php echo e($value['id']); ?>" title="Update"
                                                class="edit-detail"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                                            <a data-id="<?php echo e($value['id']); ?>" title="Delete" href="#"
                                                class="delete-detail"><i class="fas fa-trash-alt"
                                                    style="font-size: 20px;"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div id="form-elements" class="xx-row">

                </div>
            </div>
        </section>

    </div>
    <input type="hidden" id="return-back-route" value=<?php echo e(route('budget.index')); ?> />
    <input type="hidden" id="update-budget-route" value=<?php echo e(route('budget.update', 'id')); ?> />

    <input type="hidden" id="load-budget-detail-route" value=<?php echo e(route('budget.add_budget_view')); ?> />
    <input type="hidden" id="add-budget-detail-route" value=<?php echo e(route('budget.add_budget')); ?> />
    <input type="hidden" id="budget-id" value="<?php echo e($budget->id); ?>" />
    <input type="hidden" id="get-budget-category-route" value=<?php echo e(route('common.get_subcategory')); ?> />
    <input type="hidden" id="budget-detail-edit-view-route" value=<?php echo e(route('budget.budget_detail_edit_view_route')); ?> />
    <input type="hidden" id="budget-detail-update" value=<?php echo e(route('budget_detail.update')); ?> />
    <input type="hidden" id="budget-detail-delete-route" value=<?php echo e(route('budget_detail.delete')); ?> />
    <?php echo $__env->make('employee.budget.budget-child-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('employee-js'); ?>
    <script src="<?php echo e(asset('public/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/additional-methods.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/add-budget-detail.js')); ?>"></script>
    <script>
        $(document).ready(function() {
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

<?php echo $__env->make('employee.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/finance/resources/views/employee/budget/edit.blade.php ENDPATH**/ ?>