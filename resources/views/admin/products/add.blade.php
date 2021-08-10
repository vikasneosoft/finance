@extends('admin.layout')
@section('title')
    Add Product
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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
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
                            <h3 class="card-title">Product</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::open(['method' => 'POST', 'id' => 'add-form', 'file' => true]) }}
                        @include('admin.products.formElements',['submitButtonText' => 'Add'])
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
                            } else {
                                this.value = "";
                            }
                        });
                };
            })(jQuery);
            // Install input filters.

            $("#price").inputFilter(function(value) {
                return /^-?\d*[.,]?\d*$/.test(value);
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
                    price: {
                        required: true,
                        number: true,
                    },
                    category_id: {
                        required: true,
                    },
                    image: {
                        required: true,
                        accept: "image/jpg,image/jpeg,image/png"
                    },
                    description: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Product name is required.",
                        alpha: "Invalid name format"
                    },
                    price: {
                        required: "Product price is required.",
                        number: "Invalid  format"
                    },
                    category_id: {
                        required: "Select category",
                    },
                    image: {
                        required: "Upload image",
                        accept: 'Not an image!'
                    },
                    description: {
                        required: "Description is required",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    var form = $('#add-form')[0];
                    var data = new FormData(form);

                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: data,
                        url: "{{ route('products.store') }}",
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(data) {
                            window.location.href =
                                "{{ route('products.index') }}";
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
                                $('textarea[name="' + i + '"]').closest(
                                        '.form-group')
                                    .addClass('has-error');
                                $('textarea[name="' + i + '"]').closest(
                                        '.form-group')
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
