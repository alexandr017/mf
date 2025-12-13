 $(document).ready(function(){

	$("#rowtbl").DataTable({
        "sort": true,
        "pageLength": 50,
        "language": {"url": "/admin-assets/dataTables/datatables.json"}
    });
    
});
