@extends('admin.layout')
@section('title')
    Add Approval list
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
                        <li class="breadcrumb-item active">Add Approval list</li>
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
                            <h3 class="card-title">Approval list</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::open(['method' => 'POST', 'id' => 'add-form']) }}
                        @include('admin.approvallist.formElements',['submitButtonText' => 'Add'])
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

            $("#level_one_max,#level_two_max,#level_three_max,#level_four_max,#level_five_max").inputFilter(
                function(value) {
                    return /^-?\d*[.,]?\d*$/.test(value);
                });

            $("#add-form").validate({
                rules: {
                    employe_id: {
                        required: true
                    },
                    level_one_id: {
                        required: true,
                    },
                    level_one_max: {
                        required: true,
                    },
                    level_two_id: {
                        required: true,

                    },
                    level_two_max: {
                        required: true,
                    },
                    level_three_id: {
                        required: true,

                    },
                    level_three_max: {
                        required: true,
                    },
                    level_four_id: {
                        required: true,

                    },
                    level_four_max: {
                        required: true,
                    },
                    level_five_id: {
                        required: true,

                    },
                    level_five_max: {
                        required: true,
                    }
                },
                messages: {
                    employe_id: {
                        required: "Select employe",
                    },
                    level_one_id: {
                        required: "Level one field is required",
                        email: "Email is not valid"
                    },
                    level_one_max: {
                        required: "Level one max field is required",
                    },
                    level_two_id: {
                        required: "Level two field is required",
                        email: "Email is not valid"
                    },
                    level_two_max: {
                        required: "Level two max field is required",
                    },
                    level_three_id: {
                        required: "Level three field is required",
                        email: "Email is not valid"
                    },
                    level_three_max: {
                        required: "Level three max field is required",
                    },
                    level_four_id: {
                        required: "Level four field is required",
                        email: "Email is not valid"
                    },
                    level_four_max: {
                        required: "Level four max field is required",
                    },
                    level_five_id: {
                        required: "Level five field is required",
                        email: "Email is not valid"
                    },
                    level_five_max: {
                        required: "Level five max field is required",
                    }
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#add-form').serialize(),
                        url: "{{ route('approval-list.store') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(response) {
                            window.location.href =
                                "{{ route('approval-list.index') }}";
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
