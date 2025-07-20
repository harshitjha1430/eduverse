jQuery(document).ready(function($) {

/*------------------------------------------------
            DECLARATIONS
------------------------------------------------*/

    var loader = $('#loader');
    var loader_container = $('#preloader');
    var scroll = $(window).scrollTop();  
    var scrollup = $('.backtotop');
    var menu_toggle = $('.menu-toggle');
    var dropdown_toggle = $('.main-navigation button.dropdown-toggle');
    var nav_menu = $('.main-navigation ul.nav-menu');



/*------------------------------------------------
            MAIN NAVIGATION
------------------------------------------------*/

      $('.main-navigation ul li.search-menu a').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('search-active');
        $('.main-navigation #search').fadeToggle();
        $('.main-navigation .search-field').focus();
    });

    $(document).click(function (e) {
        var container = $("#masthead");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('#site-navigation').removeClass('menu-open');
            $('#primary-menu').slideUp();
            $('.menu-overlay').removeClass('active');
              $('.main-navigation ul li.search-menu a').removeClass('search-active');
            $('.main-navigation #search').fadeOut();
        }
    });

    $(document).keyup(function(e) {
        event.preventDefault();
        if (e.keyCode === 27) {
            $('.site-branding-wrapper ul li.search-menu a').removeClass('search-active');
            $('.site-branding-wrapper #search').hide();

            $('#site-navigation').removeClass('menu-open');
            $('#primary-menu').slideUp();
            $('.menu-overlay').removeClass('active');
              $('.main-navigation ul li.search-menu a').removeClass('search-active');
            $('.main-navigation #search').fadeOut();
        }
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            $('.menu-sticky #masthead').addClass('nav-shrink');
        } 
        else {
            $('.menu-sticky #masthead').removeClass('nav-shrink');
        }
    });


/*------------------------------------------------
            SLICK SLIDER
------------------------------------------------*/

$('.featured-slider').slick();

$('#testimonial-section .testimonial-slider').slick({
        responsive: [
        {
            breakpoint: 1023,
            settings: {
            slidesToShow: 2
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1
            }
        }
        ]
    });

$( '#inner-content-wrapper' ).addClass( 'wrapper' );

/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});