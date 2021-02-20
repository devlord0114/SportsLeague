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
    $('.btn-info').click(function() {
        editGame();
    });
    $('#image').on('click', function() {
        $('#attachment').click();
    });
    url = window.location.href
    console.log(window.location.href);
});

var changeLeague = function(value) {
    url = removeParam(url, 'game');
    window.location = updateQueryStringParameter(url, 'league', value);
}

var editGame = function(value) {
    window.location = updateQueryStringParameter(url, 'game', selectedItem);
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

function removeParam(uri, key) {
    var rtn = uri.split("?")[0],
        param,
        params_arr = [],
        queryString = (uri.indexOf("?") !== -1) ? uri.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

var showImage = function() {
    if($('input[name=attachment]').prop('files')[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image').attr('src', e.target.result).width(300).height(300);
            $('#image_detail').val($('#image').attr('src'));
        };
        reader.readAsDataURL($('input[name=attachment]').prop('files')[0]);
    }
}