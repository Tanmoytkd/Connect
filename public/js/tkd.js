$(document).ready(function() {
    var elem = $('#myheader');
    var contentPlacement = elem.position().top + elem.height();
    $('#spacer').css('height',contentPlacement);

    var elem = document.getElementById('message-line');

    if(elem!=null) {
        elem.scrollTop = elem.scrollHeight;
    }
});

$(window).on("load",function(){
    // $(".chat-hist, .messages-line").mCustomScrollbar({
    //     axis:"xy"
    // });
    // $(".chat-hist, .messages-line").mCustomScrollbar();

    var elem = document.getElementById('message-line');
    if(elem!=null) {
        elem.scrollTop = elem.scrollHeight;
    }
});
