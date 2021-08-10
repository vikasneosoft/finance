
$("#from_date").datetimepicker({
    icons: {
        next: 'arrow-bt fa fa-angle-right',
        previous: 'arrow-bt fa fa-angle-left'
    },
    format: 'DD-MM-YYYY',
});

$('#to_date').datetimepicker({
    icons: {
        next: 'arrow-bt fa fa-angle-right',
        previous: 'arrow-bt fa fa-angle-left'
    },
    useCurrent: true,
    format: 'DD-MM-YYYY',
});

$("#from_date").on("dp.change", function (e) {
    $('#to_date').data("DateTimePicker").minDate(e.date);
});

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
                $('#budget_subcategory_id').html(subcategory);
            } else {
                $("#budget_subcategory_id").html('');
            }

        }
    });
});

$(document).on("click", ".load-form-element", function () {

    let url = $('#load-expensive-detail-form-route').val();
    var id = $(this).attr('data-id');
    let balance = $(this).attr('data-balance');

    if(balance<=0){

        bootbox.confirm({
            message: "Budget is less, expense is more, do you still want to go ahead and make the expense ?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
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
                            $('#header-form').css({ display: "none" })

                            $("#form-elements").html(response.data);

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

                            $("#expensive_quantity").inputFilter(function (value) {
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

                            $("#expensive_rate").inputFilter(function (value) {
                                return /^-?\d*[.,]?\d*$/.test(value);
                            });

                        },
                    });
                }
            }
        });



    }else{
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
                $('#header-form').css({ display: "none" })

                $("#form-elements").html(response.data);

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

                $("#expensive_quantity").inputFilter(function (value) {
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

                $("#expensive_rate").inputFilter(function (value) {
                    return /^-?\d*[.,]?\d*$/.test(value);
                });

            },
        });
    }


});

$(document).on("click", "#add-expensive-form", function (e) {
    $("#add-expensive-form").validate({
        rules: {
            expensive_code: {
                required: true,
            },
            budget_type_id: {
                required: true,
            },
            financial_year: {
                required: true,
            },
            cost_center_id: {
                required: true,
            },
            project_code_id: {
                required: true,
            },
            project_in_charge: {
                required: true,
            },
            vendor_contacts: {
                required: true,
            },
            vendor: {
                required: true,
            },
            reason_for_selecting_vendor: {
                required: true,
            },
            assumptions_or_inclusions: {
                required: true,
            },
            exceptions_or_exclusions: {
                required: true,
            },
            payment_terms: {
                required: true,
            },
            warranty_guarantee_details: {
                required: true,
            },
            from_date: {
                required: true,
            },
            to_date: {
                required: true,
            },
            proj_ref_no: {
                required: true,
            }
        },
        messages: {
            expensive_code: {
                required: "Expensive code is required",
            },
            budget_type_id: {
                required: "Select type",
            },
            financial_year: {
                required: "Select financial year",
            },
            cost_center_id: {
                required: "Select cost center",
            },
            project_code_id: {
                required: "Select project code"
            },
            project_in_charge: {
                required: "Project incharge field is required",
            },
            vendor_contacts: {
                required: "Vendor contact field is required",
            },
            vendor: {
                required: "Budget vendor field is required",
            },
            reason_for_selecting_vendor: {
                required: "Reason field is required",
            },
            assumptions_or_inclusions: {
                required: "Assumption or inclusion field is required",
            },
            exceptions_or_exclusions: {
                required: "Exceptions or exclusions field is required",
            },
            payment_terms: {
                required: "Payment term is required",
            },
            warranty_guarantee_details: {
                required: "Warranty guarantee detail field is required",
            },
            from_date: {
                required: "Select strat date",
            },
            to_date: {
                required: "Select end date",
            },
            proj_ref_no: {
                required: "Budget proj ref field is required",
            }
        },
        errorElement: 'span',
        errorClass: 'error',
        submitHandler: function (form) {
            $('.delete-expenses,.load-form-element').removeClass('d-none');
            let url = $('#add-expensive-route').val();
            $.ajax({
                dataType: 'json',
                method: 'post',
                data: $('#add-expensive-form').serialize(),
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
                    $("#budget-detail-div").css({
                        "display": "block"
                    });

                    $('.delete-expenses,.load-form-element').removeClass('d-none')
                    $('.help-block').addClass('d-none');
                    $('#save-btn').css({ display: "none" })
                    $('#expensive-id').val(response.expensiveId)

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $('#save-btn').css({ display: "block" })
                    $('.delete-expenses,.load-form-element').addClass('d-none')
                    $.each(xhr.responseJSON.errors, function (i, obj) {
                        $('input[name="' + i + '"]').closest(
                            '.form-group').find('label.help-block').removeClass('d-none').slideDown(
                                400).html(
                                    obj);
                        $('select[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(
                                400).html(
                                    obj);
                    });
                }
            });
        }
    });
});

$(document).on("click", "#edit-expensive-form", function (e) {
    $("#edit-expensive-form").validate({
        rules: {
            expensive_code: {
                required: true,
            },
            budget_type_id: {
                required: true,
            },
            financial_year: {
                required: true,
            },
            cost_center_id: {
                required: true,
            },
            project_code_id: {
                required: true,
            },
            project_in_charge: {
                required: true,
            },
            vendor_contacts: {
                required: true,
            },
            vendor: {
                required: true,
            },
            reason_for_selecting_vendor: {
                required: true,
            },
            assumptions_or_inclusions: {
                required: true,
            },
            exceptions_or_exclusions: {
                required: true,
            },
            payment_terms: {
                required: true,
            },
            warranty_guarantee_details: {
                required: true,
            },
            from_date: {
                required: true,
            },
            to_date: {
                required: true,
            },
            proj_ref_no: {
                required: true,
            }
        },
        messages: {
            expensive_code: {
                required: "Expensive code field is required",
            },
            budget_type_id: {
                required: "Select type",
            },
            financial_year: {
                required: "Select financial year",
            },
            cost_center_id: {
                required: "Select cost center",
            },
            project_code_id: {
                required: "Select project code"
            },
            project_in_charge: {
                required: "Project incharge field is required",
            },
            vendor_contacts: {
                required: "Vendor contact field is required",
            },
            vendor: {
                required: "Budget vendor field is required",
            },
            reason_for_selecting_vendor: {
                required: "Reason is required",
            },
            assumptions_or_inclusions: {
                required: "Assumption or inclusion is required",
            },
            exceptions_or_exclusions: {
                required: "Exceptions or exclusions is required",
            },
            payment_terms: {
                required: "Payment term is required",
            },
            warranty_guarantee_details: {
                required: "Warranty guarantee detail is required",
            },
            from_date: {
                required: "Select start date",
            },
            to_date: {
                required: "Select end date",
            },
            proj_ref_no: {
                required: "Budget proj ref field is required",
            }
        },
        errorElement: 'span',
        errorClass: 'error',
        submitHandler: function (form) {
            let url = $('#update-expensive-route').val();
            $.ajax({
                dataType: 'json',
                method: 'post',
                data: $('#edit-expensive-form').serialize(),
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
                    $('.help-block').addClass('d-none');

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $.each(xhr.responseJSON.errors, function (i, obj) {
                        $('input[name="' + i + '"]').closest(
                            '.form-group').find('label.help-block').removeClass('d-none').slideDown(
                                400).html(
                                    obj);
                        $('select[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(
                                400).html(
                                    obj);
                    });
                }
            });
        }
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
            expensive_for: {
                required: true,
            },
            expensive_quantity: {
                required: true,
            },
            expensive_rate: {
                required: true,
            },

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

            expensive_for: {
                required: "Expense for field is required",
            },
            expensive_quantity: {
                required: "Quantity field is required",
            },
            expensive_rate: {
                required: "Rate field is required",
            },

        },
        errorElement: 'span',
        errorClass: 'error',
        submitHandler: function (form) {

            var form = $('#add-form')[0];
            var data = new FormData(form);
            let expensiveId = $('#expensive-id').val();
            let budgetId = $('#budget-id').val();

            data.append('expensiveId', expensiveId);
            data.append('budget_id', budgetId);
            let url = $('#add-expensive-detail-route').val();
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
                    $("#expense-detail-div").css({
                        "display": "block"
                    });

                    $('.help-block').addClass('d-none');
                    //$('#budget-id-span').html(response.budgetId)

                    $("#load-table").html(response.data);
                    $("#budget-detail-div").html(response.budgetDetail);
                    $('#header-form').css({ display: "block" })
                    $("#form-elements").html('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $.each(xhr.responseJSON.errors, function (i, obj) {

                        $('input[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(
                                400).html(
                                    obj);

                        $('textarea[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(
                                400).html(
                                    obj);

                        $('select[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(
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
    $("#header-form").css({ display: "block" });
    $('.close-detail-element').addClass('d-none');
    $('.add-detail-element').removeClass('d-none')
})

$(document).on("click", ".edit-detail", function (e) {

    e.preventDefault();
    var id = $(this).attr('data-id');
    let url = $('#expensive-detail-edit-view-route').val();
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

            $('#header-form').css({ display: "none" })
            $("#form-elements").html(response.data);

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

            $("#expensive_quantity").inputFilter(function (value) {
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

            $("#expensive_rate").inputFilter(function (value) {
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
            expensive_for: {
                required: true,
            },
            expensive_quantity: {
                required: true,
            },
            expensive_rate: {
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

            expensive_for: {
                required: "Expense for field is required",
            },
            expensive_quantity: {
                required: "Quantity field is required",
            },
            expensive_rate: {
                required: "Rate field is required",
            },
        },
        errorElement: 'span',
        errorClass: 'error',
        submitHandler: function (form) {
            formData = new FormData($('#edit-form')[0]);
            let url = $('#expensive-detail-update').val();
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
                    $('#header-form').css({ display: "block" })
                    $("#load-table").html(response.data);
                    $("#budget-detail-div").html(response.budgetDetail);
                    $("#form-elements").html('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingImage").css({
                        "display": "none"
                    });
                    $.each(xhr.responseJSON.errors, function (i, obj) {

                        $('input[name="' + i + '"]').closest('.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(400).html(
                                obj);

                        $('textarea[name="' + i + '"]').closest(
                            '.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(400).html(
                                obj);

                        $('select[name="' + i + '"]').closest('.form-group')
                            .find('label.help-block').removeClass('d-none').slideDown(400).html(
                                obj);
                    });
                }
            });
        }
    });
});

$(document).on("click", ".delete-expenses", function (e) {
    e.preventDefault();
    let id = $('#expensive-id').val();
    let url = $('#expensive-delete-route').val();
    let returnUrl = $('#return-back-route').val();
    bootbox.confirm("Are you sure you want to delete?", function (result) {
        if (result) {
            $.ajax({
                url: url,
                type: "post",
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
                    window.location.href = returnUrl;
                },
            });
        }
    });

})

$(document).on("click", ".delete-detail", function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    let url = $('#expensive-detail-delete-route').val();
    bootbox.confirm("Are you sure you want to delete?", function (result) {
        if (result) {
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
        }
    })

})

$(document).on("click", ".add-detail-element", function (e) {
    e.preventDefault();
    let url = $('#load-expensive-detail-form-route').val();
    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: 0,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        context: this,

        beforeSend: function () {

        },
        success: function (response) {
            $(this).addClass('d-none');
            $('#header-form').css({ display: "none" })
            $('.close-detail-element').removeClass('d-none')
            $("#form-elements").html(response.data);

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

            $("#expensive_quantity").inputFilter(function (value) {
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

            $("#expensive_rate").inputFilter(function (value) {
                return /^-?\d*[.,]?\d*$/.test(value);
            });

        },
    });
})

$(document).on("click", ".close-detail-element", function (e) {
    e.preventDefault();
    $(this).addClass('d-none');
    $('.add-detail-element').removeClass('d-none')
    $('#header-form').css({ display: "block" })
    $("#form-elements").html('');
})

$(document).on("click", ".submit-for-approval", function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let budgetId = $(this).attr('data-budgetId');
    let expenseAmount = $('#total-amount').val();
    let submittedAExpenseAmount = parseFloat( $(this).attr('data-expense'));
    let budgetAmount = parseFloat($(this).attr('data-budget'));
    let url = $('#expense-submit-route').val();
    if(submittedAExpenseAmount>budgetAmount){
        bootbox.confirm({
                message: "Budget is less, expense is more, do you still submit the expense ?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: url,
                        type: "POST",
                        data: {
                            id: id,
                            budgetId:budgetId,
                            expense_amount: expenseAmount
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(response) {
                            location.reload();
                        },
                    });
                    }
                }
            });
    }else{
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
                budgetId:budgetId,
                expense_amount: expenseAmount
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
               location.reload();

            },
        });
    }




})

$(document).on("click", ".create-clone", function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let url = $('#clone-expense-route').val();
    bootbox.confirm("Are you sure you want to create a similar expense?", function (result) {
        if (result) {
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
                    location.reload();
                },
            });
        }
    });




})

