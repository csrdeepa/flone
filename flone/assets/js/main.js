(function($) {
    "use strict";

    $(window).on('load', function () {
        if($('#flone-preloader').length){
            $('#flone-preloader').delay(200).fadeOut('slow');
            $('body').delay(200).css({ 'overflow': 'visible' });
        }
    })

    if ($('.search-active').length) {
        /* Cart search */
        $(".search-active").on("click", function(e) {
            e.preventDefault();
            $(this).parent().find('.search-content').slideToggle('medium');
            $(this).parent().toggleClass('toggled');
        });


        /*Close When Click Outside*/
        $('body').on('click', function(e){
            var $target = e.target;
            if (!$($target).is('.account-satting') && !$($target).parents().is('.account-satting') && $('.account-satting').hasClass('toggled')) {
                $('.account-dropdown').slideToggle('medium');
                $('.account-satting').toggleClass('toggled');
            }
        });
    }


    /* dropdown menu  */
    if ($('.account-satting-active').length) {
        $(".account-satting-active").on("click", function(e) {
            e.preventDefault();
            $(this).parent().find('.account-dropdown').slideToggle('medium');
            $(this).parent().toggleClass('toggled');
        });

        /*Close When Click Outside*/
        $('body').on('click', function(e){
            var $target = e.target;
            if (!$($target).is('.header-search') && !$($target).parents().is('.header-search') && $('.header-search').hasClass('toggled')) {
                $('.search-content').slideToggle('medium');
                $('.header-search').toggleClass('toggled');
            }
        });
    }

    /*====== Cart ======*/
    if ($('.cart-wrap').length) {
        var iconCart = $('.icon-cart');
        iconCart.on('click', function() {
            $('.shopping-cart-content').toggleClass('cart-visible');
        });

        /*Close When Click Outside*/
        $('body').on('click', function(e){
            var $target = e.target;

            if (!$($target).is('.cart-wrap') && !$($target).parents().is('.cart-wrap') && $('.shopping-cart-content').hasClass('cart-visible')) {
                $('.shopping-cart-content').toggleClass('cart-visible');
            }
        });
    }
    
    /* Related product active */
    if($('.related-product-active').length){
        $('.related-product-active').owlCarousel({
            loop: true,
            nav: false,
            autoplay: false,
            autoplayTimeout: 5000,
            item: 4,
            margin: 30,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })
    }
    
    /*--- Quickview-slide-active ---*/
    if($('.quickview-slide-active').length){
        $('.quickview-slide-active').owlCarousel({
            loop: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            margin: 15,
            smartSpeed: 1000,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 3,
                    autoplay: true,
                    smartSpeed: 300
                },
                576: {
                    items: 3
                },
                768: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    }
    
    
    $('.quickview-slide-active a').on('click', function() {
        $('.quickview-slide-active a').removeClass('active');
    })
    
    
    /*----------------------------
        Cart Plus Minus Button
    ------------------------------ */
    // for quantity increase / decrease
    $( 'body' ).on( 'click', '.quantity .inc', function( e ) {
      var $input = $( this ).parent().parent().find( 'input.qty' );
      $input.val( parseInt( $input.val() ) + 1 );
      $input.trigger( 'change' );
    });
    $( 'body' ).on( 'click', '.quantity .dec', function( e ) {
      var $input = $( this ).parent().parent().find( 'input.qty' );
      var value = parseInt( $input.val() ) - 1;
      if ( value < 0 ) value = 0;
      $input.val( value );
      $input.trigger( 'change' );
    });
    
    
    /*--
    Menu Stick
    -----------------------------------*/
    var header = $('.sticky-bar');
    // var headerHeight = $('header').outerHeight();
    // $('header').css('height', headerHeight);
    
    var win = $(window);
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass('stick');
        } else {
            header.addClass('stick');
        }
    });
    
    
    /* jQuery MeanMenu */
    $('#mobile-menu-active').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: ".mobile-menu-area .mobile-menu",
    });
    
    
    /*-----------------------------------
        Scroll zoom
    -------------------------------------- */
    window.sr = ScrollReveal({
        duration: 800,
        reset: false
    });
    
    
    /*-----------------------
        Shop filter active 
    ------------------------- */
    $('.filter-active a').on('click', function(e) {
        e.preventDefault();
        $('.product-filter-wrapper').slideToggle();
    })
    
    
    /*---------------------
        Price slider
    --------------------- */
    var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    $(function() {
        sliderrange.slider({
            range: true,
            min: 16,
            max: 400,
            values: [0, 300],
            slide: function(event, ui) {
                amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        amountprice.val("$" + sliderrange.slider("values", 0) +
            " - $" + sliderrange.slider("values", 1));
    });
    
    
    /* Language dropdown */
    // $(".language-style a").on("click", function(e) {
    //     e.preventDefault();
    //     $(this).parent().find('.lang-car-dropdown').slideToggle('medium');
    // })
    
    
    /* use style dropdown */
    $(".use-style > a").on("click", function(e) {
        e.preventDefault();
        $(this).parent().find('.lang-car-dropdown').slideToggle('medium');
    })
    
    
    /*=========================
        Toggle Ativation
    ===========================*/
    function itemToggler() {
        $(".toggle-item-active").slice(0, 8).show();
        $(".item-wrapper").find(".loadMore").on('click', function(e) {
            e.preventDefault();
            $(this).parents(".item-wrapper").find(".toggle-item-active:hidden").slice(0, 4).slideDown();
            if ($(".toggle-item-active:hidden").length == 0) {
                $(this).parent('.toggle-btn').fadeOut('slow');
            }
        });
    }
    itemToggler();
    
    
    function itemToggler2() {
        $(".toggle-item-active2").slice(0, 8).show();
        $(".item-wrapper2").find(".loadMore2").on('click', function(e) {
            e.preventDefault();
            $(this).parents(".item-wrapper2").find(".toggle-item-active2:hidden").slice(0, 4).slideDown();
            if ($(".toggle-item-active2:hidden").length == 0) {
                $(this).parent('.toggle-btn2').fadeOut('slow');
            }
        });
    }
    itemToggler2();
    
    function itemToggler3() {
        $(".toggle-item-active3").slice(0, 8).show();
        $(".item-wrapper3").find(".loadMore3").on('click', function(e) {
            e.preventDefault();
            $(this).parents(".item-wrapper3").find(".toggle-item-active3:hidden").slice(0, 4).slideDown();
            if ($(".toggle-item-active3:hidden").length == 0) {
                $(this).parent('.toggle-btn3').fadeOut('slow');
            }
        });
    }
    itemToggler3();
    
    
    /*--------------------------
        ScrollUp
    ---------------------------- */
    if( typeof $.scrollUp !== "undefined" ){
        $.scrollUp({
            scrollText: '<i class="fa fa-angle-double-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade'
        });
    }

    
    
    /*--------------------------
        Isotope
    ---------------------------- */
    if($('.grid').length){
        $('.grid').imagesLoaded(function() {
            // init Isotope
            $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                layoutMode: 'masonry',
                masonry: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: '.grid-sizer',
                }
            });
        });
    }
    
    
    /*--- Clickable menu active ----*/
    if($('#menu').length){
        const slinky = $('#menu').slinky();
    }
    
    /*====== sidebarCart ======*/
    function sidebarMainmenu() {
        var menuTrigger = $('.clickable-mainmenu-active'),
            endTrigger = $('button.clickable-mainmenu-close'),
            container = $('.clickable-mainmenu');
        menuTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('inside');
        });
        endTrigger.on('click', function() {
            container.removeClass('inside');
        });
    };
    sidebarMainmenu();
    
    
    /*=========================
        Toggle Ativation
    ===========================*/
    function itemToggler4() {
        $(".toggle-item-active4").slice(0, 6).show();
        $(".item-wrapper4").find(".loadMore4").on('click', function(e) {
            e.preventDefault();
            $(this).parents(".item-wrapper4").find(".toggle-item-active4:hidden").slice(0, 3).slideDown();
            if ($(".toggle-item-active4:hidden").length == 0) {
                $(this).parent('.toggle-btn4').fadeOut('slow');
            }
        });
    }
    itemToggler4();

    function itemToggler5() {
        $(".toggle-item-active5").slice(0, 6).show();
        $(".item-wrapper5").find(".loadMore5").on('click', function(e) {
            e.preventDefault();
            $(this).parents(".item-wrapper5").find(".toggle-item-active5:hidden").slice(0, 3).slideDown();
            if ($(".toggle-item-active5:hidden").length == 0) {
                $(this).parent('.toggle-btn5').fadeOut('slow');
            }
        });
    }
    itemToggler5();

    function itemToggler6() {
        $(".toggle-item-active6").slice(0, 6).show();
        $(".item-wrapper6").find(".loadMore6").on('click', function(e) {
            e.preventDefault();
            $(this).parents(".item-wrapper6").find(".toggle-item-active6:hidden").slice(0, 3).slideDown();
            if ($(".toggle-item-active6:hidden").length == 0) {
                $(this).parent('.toggle-btn6').fadeOut('slow');
            }
        });
    }
    itemToggler6();
    

    /*--------------------------
        Product Zoom
    ---------------------------- */
    var width = $(window).width();
    
    if( width <= 767 ){
        $('#imgzoom').removeData('elevateZoom');
        $('.zoomWrapper img.zoomed').unwrap();
        $('.zoomContainer').remove();
        $("#imgzoom").unbind("touchmove");
    }
        
    
    if($('.zoompro').length){
        if( width > 767 ){
            $(".zoompro").elevateZoom({
                gallery: "gallery",
                galleryActiveClass: "active",
                zoomWindowWidth: 300,
                zoomWindowHeight: 100,
                scrollZoom: false,
                zoomType: "inner",
                cursor: "crosshair"
            });
        }
    }

    $(document).on('found_variation', 'form.variations_form', function (event, variation) {
        if($('.zoompro').length){
            var variation_large_image = $('.zoompro').attr('data-large_image');
            $('.zoompro').attr('src', variation_large_image);
            if( width > 767 ){
                $(".zoompro").elevateZoom({
                    gallery: "gallery",
                    galleryActiveClass: "active",
                    zoomWindowWidth: 300,
                    zoomWindowHeight: 100,
                    scrollZoom: false,
                    zoomType: "inner",
                    cursor: "crosshair"
                });
            }
        }
    }).on('reset_image', function (event) {
       if($('.zoompro').length){
        if( width > 767 ){
            $(".zoompro").elevateZoom({
                gallery: "gallery",
                galleryActiveClass: "active",
                zoomWindowWidth: 300,
                zoomWindowHeight: 100,
                scrollZoom: false,
                zoomType: "inner",
                cursor: "crosshair"
            });
           }
       }
    }); 

    $('.single-product #gallery a').on('click', function(){
        var $image_src = $(this).data('zoom-image');
        $('.woocommerce-product-gallery__image .zoompro').attr('src', $image_src);
        $('.woocommerce-product-gallery__image .zoompro').attr('data-large_image', $image_src);
    });
    
    /*---------------------
        Product dec slider
    --------------------- */
    if($('.product-dec-slider-1').length){
        $('.product-dec-slider-1').slick({
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            centerPadding: '60px',
            prevArrow: '<span class="product-dec-icon product-dec-prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="product-dec-icon product-dec-next"><i class="fa fa-angle-right"></i></span>',
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
    
    /*---------------------
        Product dec slider
    --------------------- */
    if($('.product-dec-slider-2').length){
        $('.product-dec-slider-2').slick({
            infinite: true,
            slidesToShow: 4,
            vertical: true,
            slidesToScroll: 1,
            centerPadding: '60px',
            prevArrow: '<span class="product-dec-icon product-dec-prev"><i class="fa fa-angle-up"></i></span>',
            nextArrow: '<span class="product-dec-icon product-dec-next"><i class="fa fa-angle-down"></i></span>',
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
    
    /*---------------------
        Video popup
    --------------------- */
    if($('.video-popup').length){
        $('.video-popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            zoom: {
                enabled: true,
            }
        });
    }
    
    
    /*---------------------
        Sidebar active
    --------------------- */
    if($('.sidebar-active').length){
        $('.sidebar-active').stickySidebar({
            topSpacing: 100,
            bottomSpacing: 30,
            minWidth: 767,
        });
    }
    
    
    /* Product details slider */
    if($('.product-details-slider-active').length){
        $('.product-details-slider-active').owlCarousel({
            loop: false,
            nav: true,
            autoplay: false,
            autoplayTimeout: 5000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            item: 3,
            center: true,
            startPosition: 1,
            margin: 30,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    }
    
    
    /*--
    Magnific Popup
    ------------------------*/
    if($('.img-popup').length){
        $('.img-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }
    
    
    /*-------------------------
    Create an account toggle
    --------------------------*/
    $('.checkout-toggle2').on('click', function() {
        $('.open-toggle2').slideToggle(1000);
    });
    
    $('.checkout-toggle').on('click', function() {
        $('.open-toggle').slideToggle(1000);
    });
    

    /*---- CounterUp ----*/
    if($('.count').length){
        $('.count').counterUp({
            delay: 10,
            time: 1000
        });
    }
    
    
    /* Blog img slide active */
    if($('.blog-img-slide').length){
        $('.blog-img-slide').owlCarousel({
            loop: true,
            nav: true,
            autoplay: false,
            autoplayTimeout: 5000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            item: 1,
            margin: 30,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    // Quickview slider
      function quickViewThumb(){
          $('.product-dec-slider-1').slick({
              slidesToShow: 3,
              slidesToScroll: 1,
              dots: false,
              arrows: true,
              focusOnSelect: true,
              prevArrow: '<span class="product-dec-icon product-dec-prev"><i class="fa fa-angle-left"></i></span>',
              nextArrow: '<span class="product-dec-icon product-dec-next"><i class="fa fa-angle-right"></i></span>',
          });
      }

    //Quickview
      jQuery('body').append('<div class="modal fade single-product woocommerce" id="exampleModal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button></div><div class="modal-body"><div class="row"></div></div></div></div></div>');

    //show quick view
    jQuery('.quickview').each(function(){
     var quickviewLink = jQuery(this);
     var productID = quickviewLink.attr('data-quick-id');

     quickviewLink.on('click', function(event){
        event.preventDefault();

        jQuery('.modal-body').html(''); //*clear content
        jQuery('body').addClass('quickview');
        $('.modal-content').addClass('open loading');
        $('.modal-body').html('<div class="flonequick-loading"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-ripple"><div></div><div></div></div>');

        window.setTimeout(function(){
            
            jQuery.post(
             flone_localize_vars.ajaxurl, 
             {
              'action': 'flone_product_quickview',
              'data':   productID
             },
             function(response){
                $('.modal-content').removeClass('loading');
                $('.modal-content').css("background-color","#ffffff");
                jQuery('.modal-body').html(response);
                jQuery( '.variations_form' ).wc_variation_form();
       			jQuery( '.variations_form .variations select' ).change();
                quickViewThumb();
                $(".zoompro").elevateZoom({
                    gallery: "gallery",
                    galleryActiveClass: "active",
                    zoomWindowWidth: 300,
                    zoomWindowHeight: 100,
                    scrollZoom: false,
                    zoomType: "inner",
                    cursor: "crosshair"
                });
             });

        }, 300);

     });
    });


    

    // mega menu
    if ($('#primary-menu li > ul.mega-menu').length > 0) {
        $('#primary-menu li > ul.mega-menu').each(function () {
            var src = $(this).attr('data-src');
            if(src !== undefined){
                $(this).css({
                    'background-image': 'url(' + src + ')'
                });
            }
        });
    }

    // Sticky Header Issue Solve code. 
    $(window).on('load', function(){
        var $headerHeight = $('.header-area').outerHeight();
        $('.header-area').css('min-height', $headerHeight);
    });

})(jQuery);