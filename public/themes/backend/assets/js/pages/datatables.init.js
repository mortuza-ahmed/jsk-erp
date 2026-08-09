$(document).ready(function(){
    $("#datatable").DataTable({
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100],
    }),
    $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
    $("#datatable_length select").addClass("form-select form-select-sm")
});
