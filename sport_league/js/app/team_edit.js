var selectedItem;
var url;
// Load page
$(document).ready(function() {
	console.log("ready");
    $('#dataTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('.btn-circle').click(function() {
        var value = $(this).data('value');
        selectedItem = value;
    });
    url = window.location.href
    console.log(window.location.href);
});

var changeTeam = function(value) {
	window.location = updateQueryStringParameter(url, 'team', value);
}

var changePlayer = function(value) {
	window.location = updateQueryStringParameter(url, 'player', value);
}

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}

var deletePlayer = function() {
	console.log(selectedItem);
	console.log("delete");
    $.ajax({
        url: '/include/operate/update.php',
        data: {
            table : "users",
            category: "team_edit",
            operate: "delete_player",
            id : selectedItem,
        },
        success: function (response) {
            window.location = "/team_edit.php";
        },
        error: function () {
        }
    });
}
