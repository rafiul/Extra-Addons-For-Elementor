(function($) {
    var HeroSlider = function($scope, $) {
        var activeMainSlider = $('.active-main-slider');
        // var ocOptions = oc.data('carousel-options');
        activeMainSlider.each(function(index) {
            var carousel_opt = $(this).data('carousel-options');
            jQuery(this).owlCarousel({
                dots: $(this).data("dots"),
                nav: $(this).data("nav"),
                loop: $(this).data("loop"),
                autoplay: $(this).data("autoplay"),
                autoplayTimeout: $(this).data("autoplay-timeout"),
                mouseDrag: $(this).data("mouse-drag"),
                touchDrag: $(this).data("touch-drag"),
                items: $(this).data('items'),
                autoplayHoverPause: $(this).data("auto-hover"),
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                margin: $(this).data('margin'),
                smartSpeed: $(this).data('smart-speed'),
                fluidSpeed: $(this).data('fluid-speed'),
                autoplaySpeed: $(this).data('autoplay-speed'),
                navSpeed: $(this).data('nav-speed'),
                dotsSpeed: $(this).data('dot-speed'),
                center: $(this).data('center-mode'),
                responsive: {
                    0: {
                        items: 1,
                    },
                    // breakpoint from 480 up
                    360: {
                        items: $(this).data('mobile-items'),
                        margin: $(this).data('mobile-margin')
                    },
                    // breakpoint from 768 up
                    768: {
                        items: $(this).data('tablet-items'),
                        margin: $(this).data('tablet-margin')
                    },
                    992: {
                        items: $(this).data('medium-items'),
                        margin: $(this).data('medium-margin')
                    },
                    1200: {
                        items: $(this).data('items'),
                    }
                }
            });
        });
    };

    var MasonryBlogLayouts = function($scope, $) {
        jQuery('.masonaryactive').imagesLoaded( function() {
            var blogMasonry = jQuery('.masonaryactive');
               blogMasonry.masonry({
                    itemSelector: '.blog-grid-layout',
                });
        });
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/extra_addon_post_sliders.default', HeroSlider);
    });

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/extra_addon_post_layouts.default', MasonryBlogLayouts);
    });

})(jQuery);

// jQuery(document).ready(function($) {
//     $('.eafe-books-layout-section').on('click', '.load-more', function(e) {
//         e.preventDefault();
//         var that = $(this);
//         var page = that.data('page');
//         var newPage = page + 1;
//         $.ajax({
//             url: ajaxurl,
//             type: 'POST',
//             data: {
//                 action: 'book_pagination',
//                 page: page,
//             },
//             success: function(response) {
//                 that.data('page', newPage);
//                 console.log(response);
//             },
//         });
//     });
// });