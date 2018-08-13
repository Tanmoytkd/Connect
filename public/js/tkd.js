$(document).ready(function() {
    var elem = $('#myheader');
    var contentPlacement = elem.position().top + elem.height();
    $('#spacer').css('height',contentPlacement);

});
