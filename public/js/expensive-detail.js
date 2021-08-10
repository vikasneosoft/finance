
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
            let returnUrl = $('#return-back-route').val();
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
                    window.location.href = returnUrl;

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
