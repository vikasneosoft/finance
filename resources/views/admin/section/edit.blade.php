@extends('admin.layout')
@section('title')
    Edit Section
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
                        <li class="breadcrumb-item active">Edit Section</li>
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
                            <h3 class="card-title">Section</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::model($section, ['method' => 'POST', 'id' => 'edit-form', 'files' => true]) }}
                        {{ Form::hidden('action', 'edit') }}
                        {{ Form::hidden('id', $section['id'], ['id' => 'id']) }}
                        @include('admin.section.formElements',['submitButtonText' => 'Update'])
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
                    department_id: {
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
                    department_id: {
                        required: "Select department",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'PUT',
                        data: $('#edit-form').serialize(),
                        url: "{{ route('section.update', 'id') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(data) {
                            window.location.href =
                                "{{ route('section.index') }}";
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
