// Load page
$(document).ready(function() {
	console.log("ready");
	$('#avatar').on('click', function() {
        $('#attachment').click();
    });
});

var showLogo = function() {
    if($('input[name=attachment]').prop('files')[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#avatar').attr('src', e.target.result).width(300).height(300);
            $('#image').val($('#avatar').attr('src'));
        };
        reader.readAsDataURL($('input[name=attachment]').prop('files')[0]);
    }
}