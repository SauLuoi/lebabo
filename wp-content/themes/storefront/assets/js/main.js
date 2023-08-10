//header
jQuery(window).on('load', function () {
    var width = jQuery(window).innerWidth();
    if(width > 1023) {
        jQuery('.nav-expand-image').parents('a').css('font-size','0');
    } else {
        jQuery('.nav-expand-image').parents('a').empty().remove();
    }
});


jQuery(document).ready(function (){
    //sticky
    if (jQuery('.header-wrapper.header-sticky').length) {
        var prevWidth = jQuery(window).width();
        var prevScrollY = -1;
        var breakpoint = 1024;

        prevWidth = prevWidth < breakpoint? breakpoint : 0;

        function stickyHeaderUpdateHandler(testFunc) {
            var $wrapper = jQuery('body > .wrapper');
            var $header = jQuery('.header-wrapper.header-sticky');
            var $headingArchivesProduct = jQuery('.archives-product .heading')
            var $topBanner = jQuery('.top-banner');
            var width = jQuery(window).width();
            var scrollY = jQuery(window).scrollTop();
            var heights = $topBanner.length && $topBanner.outerHeight();
            var fixed;

            if (!testFunc(heights)) {
                return;
            }

            fixed = scrollY >= heights && width >= breakpoint;

            $wrapper.css('padding-top', fixed? $header.outerHeight(true) + 'px' : '');
            !fixed && $wrapper.scrollTop(0);
            $header.toggleClass('fixed', fixed);
            $headingArchivesProduct.toggleClass('fixed', fixed);
        }

        function handleResizeStickyHeader() {
            var width = jQuery(window).width();

            stickyHeaderUpdateHandler(function() {
                return width < breakpoint && prevWidth >= breakpoint || width >= breakpoint && prevWidth < breakpoint;
            });

            prevWidth = width;
        }

        function handleScrollStickyHeader() {
            var scrollY = jQuery(window).scrollTop();

            stickyHeaderUpdateHandler(function(offset) {
                return scrollY < offset && prevScrollY >= offset || scrollY >= offset && prevScrollY < offset;
            });

            prevScrollY = scrollY;
        }

        jQuery(window).on('resize', handleResizeStickyHeader);
        jQuery(window).on('scroll', handleScrollStickyHeader);
        handleResizeStickyHeader();
    }

    //toggle menu item
   jQuery('li.menu-item-has-children').append(" <span class='toggleBtn'></span>");
   jQuery('.toggleBtn').click(function (){
       jQuery(this).closest('.menu-item').children('.sub-menu').slideToggle();
       jQuery(this).closest('.menu-item').toggleClass('show');
   });


    //toggle menu mobile
    jQuery('.active-menu').click(function (){
       jQuery('.mb .main-menu').slideToggle();
    });

    //footer
    jQuery('.footer .footer-menu .footer-title').click(function(){
        jQuery(this).parent('.menu-item').find('.menu-list').slideToggle();
    });


    //Home Slider
    var $sliderHome = jQuery('.slider-home .slides').owlCarousel({
        items: 1,
        mouseDrag: false,
        smartSpeed: 1000,
        controls: false,
        loop: true,
        dots: true,
        dotsContainer: '.slider-paging .slider-thumbs',
        responsive: {
            0: {
                autoplay: true,
                animateOut: 'slideOutLeft',
                animateIn: 'slideInRight'
            },
            1025: {
                autoplay: false,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
            }
        },
        onChanged: function(e) {
            //Adjust any video in the slider to conform to the slider's width
            //Get initial slide width
            //var $vidWidth = $('video').parents('.owl-item').width();
            //Initialize video width
            //$('video').css('width', $vidWidth);
            //Resize video when window resizes
            //$win.on('resize', function(){
            //	$vidWidth = $('video').parents('.owl-item').width();
            //	$('video').css('width', $vidWidth);
            //})
        },
        onInitialized: function(e) {
            jQuery('.slider-home .slider-thumb a.slider-thumb-link').click(function(e) {
                // Allows the thumb images to link out
                e.preventDefault();
                location.href = jQuery(this).attr('href');
            });

            jQuery(document).on('click', '.owl-item.active .bgvid', function(){
                // Big gotcha, the homepage slider clones the video, we have to play the active video
                // in order for it to work on chrome
                jQuery('.owl-item.active .bgvid').get(0).play();
            });
        }
    });

    // check if there's a video that needs to be played when the slider fades in to a new slide
    jQuery('.owl-item').bind('oanimationend animationend webkitAnimationEnd', function() {
        if(typeof jQuery('.owl-item.active .bgvid').get(0) !== 'undefined' ) {
            // Big gotcha, the homepage slider clones the video, we have to play the active video
            // in order for it to work on chrome
            jQuery('.owl-item.active .bgvid').get(0).play();
        }
    });

    var mouseIsOver = null;

    if(jQuery(window).width() > 1024) {
        jQuery('.slider-home .slider-thumb').on('mouseenter', function () {
            var $this = jQuery(this);
            currentSlide = $this.index();
            $sliderHome.trigger('to.owl.carousel', [currentSlide]);

            setTimeout(function(){
                if(typeof jQuery('.owl-item.active .bgvid').get(0) !== 'undefined' ) {
                    //simulate user interaction on video
                    jQuery('.owl-item.active .bgvid')[0].play();
                }
            },500);

            /*if(mouseIsOver !== null) {
                clearTimeout(mouseIsOver);
            }

            mouseIsOver = setTimeout(function () {
            }, 200);*/
        });
    }

    function setHeightProduct() {
        var product = jQuery(".list-products .item .product-item-image");
        var widthProduct = product.width();
        product.height(widthProduct);
    }

    jQuery(window).resize(function(){
        setHeightProduct();
    });
    setHeightProduct();
});

