$(document).ready(() => {
    $('#startDate').datetimepicker({
        format: 'L',
        defaultDate: new Date()
    });

    $('#endDate').datetimepicker({
        format: 'L',
        defaultDate: new Date()
    });

    $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        responsive: true,
        scrollX: true,
    });
});

$(document).on('click', '#search', (e) => {

    let start_date = $("input[name=startDate]").val();
    let end_date = $("input[name=endDate]").val();
    let account_id = $("input[name=account_id]").val();
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    let fail = false;

    if (account_id.length < 1) {
        Toast.fire({
            icon: 'error',
            title: 'Account ID tidak boleh kosong!'
        });
        fail = true;
    }

    if (start_date.length < 1 || end_date.length < 1) {
        Toast.fire({
            icon: 'error',
            title: 'Transaction Date Tidak boleh kosong!!'
        });
        fail = true;
    }

    if (!fail) {
        // Get data by Ajax!
        $('#example2').DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: false,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            order: [],
            destroy: true,
            ajax: {
                url: `${master_url}Report/list_data`,
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    account_id: account_id
                },
                beforeSend: function() {
                    Toast.fire({
                        icon: 'info',
                        title: 'Try to getting data!'
                    });
                },
                complete: function() {
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully Retrieve Data!'
                    });
                }
            },
        });
    };


});