@extends('admin.layout')
@section('title')
    Add Supplier
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
                        <li class="breadcrumb-item active">Add Supplier</li>
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
                            <h3 class="card-title">Supplier</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::open(['method' => 'POST', 'id' => 'add-form']) }}
                        @include('admin.supplier.formElements',['submitButtonText' => 'Add'])
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

            $("#mobile_number").inputFilter(function(value) {
                return /^-?\d*$/.test(value);
            });

            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
                // --                                    or leave a space here ^^
            });
            $("#add-form").validate({
                rules: {
                    name: {
                        required: true,
                        alpha: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contact_person: {
                        required: true,

                    },
                    mobile_number: {
                        required: true,
                        number: true,
                        maxlength: 10
                    },
                    address: {
                        required: true,

                    }
                },
                messages: {
                    name: {
                        required: "Name is required",
                        alpha: "Invalid name format"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email is not valid"
                    },
                    contact_person: {
                        required: "Contact person is required",
                    },
                    mobile_number: {
                        required: "Mobile number is required",
                    },
                    address: {
                        required: "Address is required",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#add-form').serialize(),
                        url: "{{ route('supplier.store') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(response) {
                            window.location.href =
                                "{{ route('supplier.index') }}";
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
