(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Sidebar Toggler & Auto Resize Grafik
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        
        // Trik sakti maksa browser ngitung ulang ukuran grafik
        setTimeout(function () {
            window.dispatchEvent(new Event('resize'));
        }, 500);
        
        return false;
    });

})(jQuery);