$(document).on("click", ".approve-expense", function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let url = $('#approve-expense-route').val();
    let reason = $('#reason').val();
    $.ajax({
        url: url,
        type: "post",
        data: {
            id: id,
            reason: reason
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

            location.reload()
        },
    });
})
$(document).on("click", ".reject-expense", function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let budgetId = $(this).attr('data-budget');
    let url = $('#reject-expense-route').val();
    let reason = $('#reason').val();
    if (reason.trim() == "") {
        $('#error-msg').html("Please enter rejection reason");
        return false;
    } else {
        $('#error-msg').html('');
    }

    $.ajax({
        url: url,
        type: "post",
        data: {
            id: id,
            budgetId:budgetId,
            reason: reason
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

            location.reload()
        },
    });
})

