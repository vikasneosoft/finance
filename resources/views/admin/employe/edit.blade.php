@extends('admin.layout')
@section('title')
    Edit Employe
@endsection
@section('admin-css')

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
                        <li class="breadcrumb-item active">Edit User</li>
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
                            <h3 class="card-title">Employe</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::model($employe, ['method' => 'POST', 'id' => 'edit-form', 'files' => true]) }}
                        {{ Form::hidden('action', 'edit') }}
                        {{ Form::hidden('id', $employe['id'], ['id' => 'id']) }}
                        @include('admin.employe.formElements',['submitButtonText' => 'Update'])
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
    <script>
        $(document).ready(function() {

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

            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
                // --                                    or leave a space here ^^
            });

            $("#edit-form").validate({
                rules: {
                    name: {
                        required: true,
                        //   alpha: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    company_id: {
                        required: true,
                    },
                    /*  location_id: {
                         required: true,
                     },
                     division_id: {
                         required: true,
                     }, */
                    /* department_id: {
                        required: true,
                    },
                    section_id: {
                        required: true,
                    } */

                },
                messages: {
                    name: {
                        required: "Name is required.",
                        alpha: "Invalid name format"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email is not valid"
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
                        required: "Select department",
                    },
                    section_id: {
                        required: "Select section",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'PUT',
                        data: $('#edit-form').serialize(),
                        url: "{{ route('employe.update', 'id') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(data) {
                            window.location.href =
                                "{{ route('employe.index') }}";
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

@endsection
