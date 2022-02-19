$(document).ready(() => {
    $('#reservationdate').datetimepicker({
        format: 'L',
        defaultDate: new Date()
    });

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

$(document).on('click', "#search", () => {

    let start_date = $("#startDate").val();
    let end_date = $("#endDate").val();
    let account_id = $("#account_id").val();


});