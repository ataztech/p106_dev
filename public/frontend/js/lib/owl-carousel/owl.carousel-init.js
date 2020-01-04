(function ($) {
    "use strict";

    
    $('.testimonial-widget-one-0, .testimonial-widget-one-1, .testimonial-widget-one-2, .testimonial-widget-one-3, .testimonial-widget-one-4, .testimonial-widget-one-5, .testimonial-widget-one-6, .testimonial-widget-one-7, .testimonial-widget-one-8, .testimonial-widget-one-9, .testimonial-widget-one-10, .testimonial-widget-one-11, .testimonial-widget-one-12, .testimonial-widget-one-13, .testimonial-widget-one-14').owlCarousel({
        singleItem: true,
        loop: true,
        autoplay: false,
        //        rtl: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 4
            },
            1000: {
                items: 4
            }
        }
    })
    


    $('.statistic-slider .owl-carousel').owlCarousel({
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        loop: true,
        margin: 15,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })




})(jQuery);