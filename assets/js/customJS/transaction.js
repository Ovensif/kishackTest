$(document).ready(() => {
    $('#reservationdate').datetimepicker({
        format: 'L',
        defaultDate: new Date()
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

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
            url: `${master_url}Transaction/list_data`,
            type: "POST",
            data: {},
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
});