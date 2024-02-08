// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#saleTable').DataTable({
    "searching": false,
    "lengthChange": false, 
    "responsive": true,
    "pageLength": 5,
  });
  $('#salePerMonthTable').DataTable({
    "searching": false,
    "lengthChange": false,
    "responsive": true,
    "pageLength": 5,
  });
});
