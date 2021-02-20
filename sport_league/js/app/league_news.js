var selectedItem;
// Load page
$(document).ready(function() {
	console.log("ready");
    $('#dataTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('#avatar').on('click', function() {
        $('#attachment').click();
    });
    $('.btn-circle').click(function() {
        var value = $(this).data('value');
        selectedItem = value;
    });
    $('.btn-info').click(function() {
        editNews();
    });
});

var editNews = function() {
    window.location = "/league_news_detail.php?index=" + selectedItem + "&update=" + true;
}

var showImage = function() {
    if($('input[name=attachment]').prop('files')[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#avatar').attr('src', e.target.result).width(300).height(300);
            $('#image').val($('#avatar').attr('src'));
        };
        reader.readAsDataURL($('input[name=attachment]').prop('files')[0]);
    }
}