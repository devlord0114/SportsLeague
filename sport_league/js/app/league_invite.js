var selectedItem;
// Load page
$(document).ready(function() {
	console.log("ready");
    $('#dataTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
});