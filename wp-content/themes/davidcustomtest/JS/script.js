

jQuery(document).ready(function() {
    //Left nav
    $('#menu').children().addClass('closed');

    $('#menu > li a').click(function(e){
        e.preventDefault();
    });

    $('.closed').live('hover', function() {

        var position_open = parseInt($(this).css('bottom')) + parseInt($('.sub-menu', this).css('height')) - 12;
        $(this).animate({ bottom: position_open }, function() {
            $(this).removeClass('closed');
            $(this).addClass('opened');
        });
    });

    $('.opened').live('hover', function() {
        var position_close = parseInt($(this).css('bottom')) - parseInt($('.sub-menu', this).css('height')) + 12;
        $(this).animate({ bottom: position_close }, function() {
            $(this).removeClass('opened');
            $(this).addClass('closed');
        });
    });

});