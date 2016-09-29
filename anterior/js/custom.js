$(document).ready(function() {
	
	$("a.fancylightbox").fancybox({
		'titleShow'     : false,
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade'
	});
});
$(document).ready(function() {
            $('.adjusttransparency').each(function() {
                $(this).hover(
                    function() {
                        $(this).stop().animate({ opacity: 0.7 }, 250);
                    },
                   function() {
                       $(this).stop().animate({ opacity: 1.0 }, 250);
                   })
                });
});
