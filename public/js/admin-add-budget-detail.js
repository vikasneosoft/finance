

$(document).on("change", "#budget_category_id", function () {
    var catId = $(this).val();
    let url = $('#get-budget-category-route').val();
    $.ajax({
        dataType: 'json',
        method: 'get',
        data: {
            'catId': catId,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        beforeSend: function () {
            $("#loadingImage").css({
                "display": "block"
            });
        },
        success: function (response) {
            $("#loadingImage").css({
                "display": "none"
            });

            var subcategory = '<option value="">Select</option>';
            if (response.subcategories) {

                $.each(response.subcategories, function (key, value) {

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

$(document).on("click", ".load-form-element", function () {
    let url = $('#load-budget-detail-route').val();
    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: 0,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {

        },
        success: function (response) {

            $("#form-elements").html(response.data);
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

            $("#budget_from_date").on("dp.change", function (e) {
                $('#budget_to_date').data("DateTimePicker").minDate(e.date);
            });

            (function ($) {
                $.fn.inputFilter = function (inputFilter) {
                    return this.on("input keydown keyup mousedown mouseup select contextmenu drop",
                        function () {
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

            $("#budget_quantity").inputFilter(function (value) {
                return /^-?\d*$/.test(value);
            });
            (function ($) {
                $.fn.inputFilter = function (inputFilter) {
                    return this.on("input keydown keyup mousedown mouseup select contextmenu drop",
                        function () {
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

            $("#budget_rate").inputFilter(function (value) {
                return /^-?\d*[.,]?\d*$/.test(value);
            });

        },
    });


});
$(document).on("click", "#add-form", function (e) {
    $("#add-form").validate({
        rules: {
            budget_category_id: {
                required: true,
            },
            specifications: {
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
            },
            budget_explanation: {
                required: true,
            }
        },
        messages: {
            budget_category_id: {
                required: "Select category",
            },
            specifications: {
                required: "Specification field is required",
            },
            budget_subcategory_id: {
                required: "Select subcategory"
            },
            budget_type_id: {
                required: "Select type",
            },
            budget_for: {
                required: "Budget for field is required",
            },
            budget_quantity: {
                required: "Quantity field is required",
            },
            budget_rate: {
                required: "Rate field is required",
            },

            budget_vendor: {
                required: "Budget vendor field is required",
            },
            budget_from_date: {
                required: "Select start date",
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
        submitHandler: function (form) {
            var form = $('#add-form')[0];
            var data = new FormData(form);
            let budgetId = $('#budget-id').val();
            let empId = $('#employee-id').val();

            data.append('budgetId', budgetId);
            data.append('employee_id', empId);

            let url = $('#add-budget-detail-route').val();
            $.ajax({
                dataType: 'json',
                method: 'post',
                data: data,
                url: url,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#loadingImage").css({
                        "display": "block"
                    });
                },
                success: function (response) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $("#budget-detail-div").css({
                        "display": "block"
                    });

                    $('#budget-id-span').html(response.budgetId)
                    $('#budget-id').val(response.budgetId)
                    $("#load-table").html(response.data);
                    $("#form-elements").html('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $.each(xhr.responseJSON.errors, function (i, obj) {
                        $('input[name="' + i + '"]').closest(
                            '.form-group')
                            .addClass('has-error');
                        $('input[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').slideDown(
                                400).html(
                                    obj);
                        $('textarea[name="' + i + '"]').closest(
                            '.form-group')
                            .addClass('has-error');
                        $('textarea[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').slideDown(
                                400).html(
                                    obj);
                        $('select[name="' + i + '"]').closest(
                            '.form-group')
                            .addClass('has-error');
                        $('select[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').slideDown(
                                400).html(
                                    obj);
                    });
                }
            });
        }
    });
});

$(document).on("click", ".cancel-btn", function (e) {
    e.preventDefault();
    $("#form-elements").html('');
})

$(document).on("click", ".edit-detail", function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    let url = $('#budget-detail-edit-view-route').val();
    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {

        },
        success: function (response) {

            $("#form-elements").html(response.data);
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

            $("#budget_from_date").on("dp.change", function (e) {
                $('#budget_to_date').data("DateTimePicker").minDate(e.date);
            });

            (function ($) {
                $.fn.inputFilter = function (inputFilter) {
                    return this.on("input keydown keyup mousedown mouseup select contextmenu drop",
                        function () {
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

            $("#budget_quantity").inputFilter(function (value) {
                return /^-?\d*$/.test(value);
            });
            (function ($) {
                $.fn.inputFilter = function (inputFilter) {
                    return this.on("input keydown keyup mousedown mouseup select contextmenu drop",
                        function () {
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

            $("#budget_rate").inputFilter(function (value) {
                return /^-?\d*[.,]?\d*$/.test(value);
            });

        },
    });
})

$(document).on("click", "#edit-form", function (e) {
    $("#edit-form").validate({
        rules: {
            budget_category_id: {
                required: true,
            },
            specifications: {
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
            },
            budget_explanation: {
                required: true,
            }
        },
        messages: {

            budget_category_id: {
                required: "Select category",
            },
            specifications: {
                required: "Specifications are required",
            },
            budget_subcategory_id: {
                required: "Select subcategory"
            },
            budget_type_id: {
                required: "Select type",
            },
            budget_for: {
                required: "Budget for field is required",
            },
            budget_quantity: {
                required: "Budget quantity field is required",
            },
            budget_rate: {
                required: "Budget rate field is required",
            },

            budget_vendor: {
                required: "Budget vendor field is required",
            },
            budget_from_date: {
                required: "Select start date",
            },
            budget_to_date: {
                required: "Select end date",
            },
            budget_proj_ref_no: {
                required: "Budget proj ref field is required",
            },
            budget_explanation: {
                required: "Budget explanation field is required",
            }
        },
        errorElement: 'span',
        errorClass: 'error',
        submitHandler: function (form) {
            formData = new FormData($('#edit-form')[0]);
            let url = $('#budget-detail-update').val();

            $.ajax({
                dataType: 'json',
                type: 'POST',
                data: formData,
                url: url,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#loadingImage").css({
                        "display": "block"
                    });
                },
                success: function (response) {
                    $("#loadingImage").css({
                        "display": "none"
                    });

                    $("#load-table").html(response.data);
                    $("#form-elements").html('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $.each(xhr.responseJSON.errors, function (i, obj) {
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


$(document).on("click", ".delete-detail", function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    let url = $('#budget-detail-delete-route').val();
    $.ajax({
        url: url,
        type: "POST",
        data: {
            id: id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $("#loadingImage").css({
                "display": "block"
            });
        },
        success: function (response) {
            $("#loadingImage").css({
                "display": "none"
            });
            $('.tr-' + id).remove();


        },
    });
})
