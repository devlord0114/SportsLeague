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
        viewTeam();
    });
    $('.btn-info').click(function() {
        editTeam();
    });
});

var viewTeam = function() {
    window.location = "/team_detail.php?index=" + selectedItem + "&update=" + false;
}

var editTeam = function() {
    window.location = "/team_detail.php?index=" + selectedItem + "&update=" + true;
}

var deleteTeam = function() {
    $.ajax({
        url: '/include/operate/delete.php',
        data: {
            table : "teams",
            id : selectedItem,
        },
        success: function (response) {
            window.location = "/team_list.php";
        },
        error: function () {
        }
    });
}