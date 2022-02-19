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