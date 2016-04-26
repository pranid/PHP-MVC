$(document).ready(function() {
    var dock_class = 'col-md-3 col-sm-6 col-xs-12';
	/*$('.torty-image-dock').click(function(event) {
        $('.torty-image-dock').addClass(dock_class).delay(1000);
        $('.torty-image-dock').removeClass('torty-active').delay(1000);
        $('.torty-image-dock').css('background-image', '').delay(1000);
        
        $(this).removeClass(dock_class);
        $(this).children('img').attr('src');

        $(this).addClass('torty-active');
        $('.torty-active').css('background-image', 'url('+$(this).children('img').attr('src')+')');

	});*/

    /*$('.torty-image-dock').click(function(event) {
        console.log($(this).children('img').attr('src'));
        $('.brw-main').children('img').attr('src', $(this).children('img').attr('src'));
        $('.torty-image-browser').css({
                                    width: '100%',
                                    display: 'block'
                                });
        $('body').css('overflow-y', 'hidden');
        $('.thumb-dock-images').html($('#dock-yard').html());
        $('.thumb-dock-images').children('div').removeClass(dock_class);
        $('.thumb-dock-images').children('div').addClass('col-md-12');
        $('.thumb-dock-images').children('div').children('img').removeClass('img-thumbnail');

    });*/
    // loadTortyPreview (dock_class);

    $('body').on('click', '.torty-image-dock', function(event) {
        event.preventDefault();
        closeTortyPreview ();
        // console.log($(this).children('img').attr('src'));
        $('.brw-main').children('img').attr('src', $(this).children('img').attr('src'));
        loadTortyPreview (dock_class);        
    });

	/*$('body').on('click', function(e) {
        var image_dock 	= $(".torty-image-dock");
        if(e.target.closest('.torty-image-dock') == null) {
   			image_dock.addClass(dock_class);
            $('.torty-image-dock').css('background-image', '');
            image_dock.removeClass('torty-active');
        }
    });*/

    $('#cls-img').click(function(event) {
        closeTortyPreview ();
    });


});

function closeTortyPreview () {
    // $('.brw-main').children('img').attr('src', '');
    $('.torty-image-browser').css({
                                width: '0%',
                                display: 'none'
                            });
    $('body').css('overflow-y', 'auto');
}

function loadTortyPreview (dock_class) {
    $('.torty-image-browser').css({
                                width: '100%',
                                display: 'block'
                            });
    $('body').css('overflow-y', 'hidden');
    $('.thumb-dock-images').html($('#dock-yard').html());
    $('.thumb-dock-images').children('div').removeClass(dock_class);
    // $('.thumb-dock-images').children('div').addClass('col-md-12');
    $('.thumb-dock-images').children('div').children('img').removeClass('img-thumbnail');
    $('.thumb-dock-images').children('div').children('img').css({
        'animation': 'none',
        'margin': '6px 6px 4px 0px',
        'width': '98%',
        'box-shadow' : '0px 0px 20px 1px #000'


    });;
}