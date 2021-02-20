var selectedItem;
// Load page
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('.btn-circle').click(function() {
        var value = $(this).data('value');
        selectedItem = value;
    });
    $('.btn-warning').click(function() {
        viewLeague();
    });
    $('.btn-info').click(function() {
        editLeague();
    });
});

var viewLeague = function() {
    window.location = "/league_detail.php?index=" + selectedItem + "&update=" + false;
}

var editLeague = function() {
    window.location = "/league_detail.php?index=" + selectedItem + "&update=" + true;
}

var deleteLeague = function() {
    $.ajax({
        url: '/include/operate/delete.php',
        data: {
            table : "leagues",
            id : selectedItem,
        },
        success: function (response) {
            window.location = "/league_list.php";
        },
        error: function () {
        }
    });
}