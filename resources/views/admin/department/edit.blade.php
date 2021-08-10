@extends('admin.layout')
@section('title')
    Edit Department
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
                        <li class="breadcrumb-item active">Edit Department</li>
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
                            <h3 class="card-title">Department</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::model($department, ['method' => 'POST', 'id' => 'edit-form', 'files' => true]) }}
                        {{ Form::hidden('action', 'edit') }}
                        {{ Form::hidden('id', $department['id'], ['id' => 'id']) }}
                        @include('admin.department.formElements',['submitButtonText' => 'Update'])
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
            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
                // --                                    or leave a space here ^^
            });

            $("#edit-form").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 150
                    },
                    manager_email: {
                        required: true,
                        email: true

                    },
                    division_id: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Name is required",
                        //alpha: "Invalid name format"
                    },
                    manager_email: {
                        required: "Manager email is required",
                    },
                    division_id: {
                        required: "Select division",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'PUT',
                        data: $('#edit-form').serialize(),
                        url: "{{ route('department.update', 'id') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(data) {
                            window.location.href =
                                "{{ route('department.index') }}";
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
