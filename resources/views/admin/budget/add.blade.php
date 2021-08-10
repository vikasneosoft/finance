@extends('admin.layout')
@section('title')
    Add Budget
@endsection
@section('admin-css')
    <link href="{{ asset('public/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('admin-content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Budget</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Budget</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::open(['method' => 'POST', 'id' => 'add-form']) }}
                        @include('admin.budget.formElements',['submitButtonText' => 'Add'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('admin-js')
    <script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.js') }}"></script>
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
                            }
                        });
                };
            }(jQuery));
            // Install input filters.

            $("#budget_quantity").inputFilter(function(value) {
                return /^-?\d*$/.test(value);
            });
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

            $("#budget_amount,#budget_rate").inputFilter(function(value) {
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
                    url: "{{ route('common.get_divisions_locations_by_company') }}",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        $("#section_id").html('<option value="">Select</option>');
                        $("#department_id").html('<option value="">Select</option>');
                        var divisions = '<option value="">Select</option>';
                        var locations = '<option value="">Select</option>';


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
                    url: "{{ route('common.get_departments_by_division') }}",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        $("#section_id").html('<option value="">Select</option>');
                        var departments = '<option value="">Select</option>';

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
                    url: "{{ route('common.get_sections_by_department') }}",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        var sections = '<option value="">Select</option>';

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

            $('#budget_category_id').change(function() {

                var catId = $(this).val();
                $(".sub-choose").html('Choose');
                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    data: {
                        'catId': catId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('budget.get_subcategory') }}",
                    beforeSend: function() {
                        $("#loadingImage").css({
                            "display": "block"
                        });
                    },
                    success: function(response) {
                        $("#loadingImage").css({
                            "display": "none"
                        });
                        console.log(response.subcategories)
                        var subcategory = '';
                        if (response.subcategories) {

                            $.each(response.subcategories, function(key, value) {

                                //subcategory+='<option value="' + key + '">' + value + '</option>';
                                subcategory +=
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>';
                            });
                            console.log(subcategory)
                            $('#budget_subcategory_id').html(subcategory);
                        } else {
                            $("#budget_subcategory_id").html('');

                        }

                    }
                });
            });

            $("#budget_from_date").datetimepicker({
                icons: {
                    next: 'arrow-bt fa fa-angle-right',
                    previous: 'arrow-bt fa fa-angle-left'
                },
                format: 'DD-MM-YYYY',
            });

            $('#budget_to_date').datetimepicker({
                icons: {
                    next: 'arrow-bt fa fa-angle-right',
                    previous: 'arrow-bt fa fa-angle-left'
                },
                useCurrent: true,
                format: 'DD-MM-YYYY',
            });

            $("#budget_from_date").on("dp.change", function(e) {
                $('#budget_to_date').data("DateTimePicker").minDate(e.date);
            });

            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
                // --                                    or leave a space here ^^
            });
            $("#add-form").validate({
                rules: {
                    financial_year: {
                        required: true
                    },
                    company_id: {
                        required: true,
                    },
                    location_id: {
                        required: true,
                    },
                    division_id: {
                        required: true,
                    },
                    department_id: {
                        required: true,
                    },
                    section_id: {
                        required: true,
                    },
                    budget_category_id: {
                        required: true,
                    },
                    budget_subcategory_id: {
                        required: true,
                    },
                    budget_type_id: {
                        required: true,
                    },
                    budget_for: {
                        required: true,
                    },
                    budget_quantity: {
                        required: true,
                    },
                    budget_rate: {
                        required: true,
                    },
                    budget_amount: {
                        required: true,
                    },
                    budget_vendor: {
                        required: true,
                    },
                    budget_from_date: {
                        required: true,
                    },
                    budget_to_date: {
                        required: true,
                    },
                    budget_proj_ref_no: {
                        required: true,
                    }
                },
                messages: {
                    financial_year: {
                        required: "Financial year is required",
                    },
                    company_id: {
                        required: "Select company",
                    },
                    location_id: {
                        required: "Select location",
                    },
                    division_id: {
                        required: "Select division",
                    },
                    department_id: {
                        required: "Select departmnt",
                    },
                    section_id: {
                        required: "Select section",
                    },
                    budget_category_id: {
                        required: "Select category",
                    },
                    budget_subcategory_id: {
                        required: "Select subcategory"
                    },
                    budget_type_id: {
                        required: "Select type",
                    },
                    budget_for: {
                        required: "Budget for is required",
                    },
                    budget_quantity: {
                        required: "Quantity field is required",
                    },
                    budget_rate: {
                        required: "Budget rate is required",
                    },
                    budget_amount: {
                        required: "Budget amount is required"
                    },
                    budget_vendor: {
                        required: "Budget vendor is required",
                    },
                    budget_from_date: {
                        required: "Select start  date",
                    },
                    budget_to_date: {
                        required: "Select end date",
                    },
                    budget_proj_ref_no: {
                        required: "Budget proj ref field is required",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#add-form').serialize(),
                        url: "{{ route('budget.store') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(response) {
                            window.location.href =
                                "{{ route('budget.index') }}";
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
                                $('textarea[name="' + i + '"]').closest(
                                        '.form-group')
                                    .addClass('has-error');
                                $('textarea[name="' + i + '"]').closest(
                                        '.form-group')
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

@endsection
