/* =====================================================
Template Name   : MyTrip
Description     : Travel Booking HTML5 Template
Author          : Themesland
Version         : 1.1
=======================================================*/


(function ($) {
    "use strict";


    // multi level dropdown menu
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        var $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass('show');
        });
        return false;
    });



    // data-background    
    $(document).on('ready', function () {
        $("[data-background]").each(function () {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
    });


    // wow init
    new WOW().init();


    // hero slider
    $('.hero-slider').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        items: 1,
        navText: [
            "<i class='fas fa-long-arrow-left'></i>",
            "<i class='fas fa-long-arrow-right'></i>"
        ],

        onInitialized: function (event) {
            var $firstAnimatingElements = $('.owl-item').eq(event.item.index).find("[data-animation]");
            doAnimations($firstAnimatingElements);
        },

        onChanged: function (event) {
            var $firstAnimatingElements = $('.owl-item').eq(event.item.index).find("[data-animation]");
            doAnimations($firstAnimatingElements);
        }
    });

    //hero slider do animations
    function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function () {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationDuration = $this.data('duration');
            var $animationType = 'animated ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay,
                'animation-duration': $animationDuration,
                '-webkit-animation-duration': $animationDuration,
            });
            $this.addClass($animationType).one(animationEndEvents, function () {
                $this.removeClass($animationType);
            });
        });
    }



    // hero-slider 2
    $('.hero-slider-2').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        margin: 0,
        animateOut: 'fadeOut',
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        items: 1,
    });

   

    // partner-slider
    $('.partner-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });



    // listing-slider
    $('.listing-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        navText: [
            "<i class='far fa-long-arrow-left'></i>",
            "<i class='far fa-long-arrow-right'></i>"
        ],
        autoplay: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });



    // testimonial-slider
    $('.testimonial-slider').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        autoplay: false,
        navText: [
            "<i class='far fa-long-arrow-left'></i>",
            "<i class='far fa-long-arrow-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });


    // destination-slider
    $('.destination-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        center: true,
        navText: [
            "<i class='far fa-long-arrow-left'></i>",
            "<i class='far fa-long-arrow-right'></i>"
        ],
        autoplay: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });


    // hotel-slider
    $('.hotel-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        center: true,
        navText: [
            "<i class='far fa-long-arrow-left'></i>",
            "<i class='far fa-long-arrow-right'></i>"
        ],
        autoplay: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });



    // car-slider
    $('.car-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        center: true,
        navText: [
            "<i class='far fa-long-arrow-left'></i>",
            "<i class='far fa-long-arrow-right'></i>"
        ],
        autoplay: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });



    // preloader
    $(window).on('load', function () {
        $(".preloader").fadeOut("slow");
    });


    // fun fact counter
    $('.counter').countTo();
    $('.counter-box').appear(function () {
        $('.counter').countTo();
    }, {
        accY: -100
    });



    // magnific popup init
    $(".popup-gallery").magnificPopup({
        delegate: '.popup-img',
        type: 'image',
        gallery: {
            enabled: true
        },
    });

    $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });



    // scroll to top
    $(window).scroll(function () {

        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            $("#scroll-top").fadeIn('slow');
        } else {
            $("#scroll-top").fadeOut('slow');
        }
    });

    $("#scroll-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500);
        return false;
    });


    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass("fixed-top");
        } else {
            $('.navbar').removeClass("fixed-top");
        }
    });


    // countdown
    if ($('#countdown').length) {
        $('#countdown').countdown('2028/01/30', function (event) {
            $(this).html(event.strftime('' + '<div class="row">' + '<div class="col countdown-single">' + '<h2 class="mb-0">%-D</h2>' + '<h5 class="mb-0">Day%!d</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%H</h2>' + '<h5 class="mb-0">Hours</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%M</h2>' + '<h5 class="mb-0">Minutes</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%S</h2>' + '<h5 class="mb-0">Seconds</h5>' + '</div>' + '</div>'));
        });
    }


    // project filter
    $(window).on('load', function () {
        if ($(".filter-box").children().length > 0) {
            $(".filter-box").isotope({
                itemSelector: '.filter-item',
                masonry: {
                    columnWidth: 1
                },
            });

            $('.filter-btns').on('click', 'li', function () {
                var filterValue = $(this).attr('data-filter');
                $(".filter-box").isotope({ filter: filterValue });
            });

            $(".filter-btns li").each(function () {
                $(this).on("click", function () {
                    $(this).siblings("li.active").removeClass("active");
                    $(this).addClass("active");
                });
            });
        }
    });


    // copywrite date
    let date = new Date().getFullYear();
    $("#date").html(date);


    // nice select
    $(document).ready(function () {
        $('.select').niceSelect();
    });


    // advanced search
    $('.advanced-search').click(function () {
        $('.advanced-search-menu').toggle();
    });


    // price slider
    $(function () {
        $(".price-range").slider({
            step: 500,
            range: true,
            min: 0,
            max: 10000,
            values: [1500, 5000],
            slide: function (event, ui) { $(".priceRange").val("$" + ui.values[0].toLocaleString() + " - $" + ui.values[1].toLocaleString()); }
        });
        $(".priceRange").val("$" + $(".price-range").slider("values", 0).toLocaleString() + " - $" + $(".price-range").slider("values", 1).toLocaleString());
    });


    // profile image btn
    $(".profile-img-btn").click(function () {
        $(".profile-img-file").click();
    });


    // property images upload
    $(".property-img-upload").click(function () {
        $(".property-img-file").click();
    });


    // message bottom scroll
    if ($('.message-content-info').length) {
        $(function () {
            var chatbox = $('.message-content-info');
            var chatheight = chatbox[0].scrollHeight;
            chatbox.scrollTop(chatheight);
        });
    }


    // search date picker 
    if ($('.date-picker').length) {
        $(".date-picker").datepicker();
    }


    // find-car time picker 
    if ($('.time-picker').length) {
        $(function () {
            $(".time-picker").timepicker();
        });
    }


    // flight type search form
    $('.flight-type .form-check-input').change(function (e) {
        var ft = $(this).val();
        if (ft === "round-way") {
            $('.flight-search .search-form-return').show();
            $('.have-to-clone').hide();
            $('.another-item').remove();
        } else if (ft === "multi-city") {
            $('.flight-search .search-form-return').hide();
            $('.have-to-clone').show();
            $('.another-item').remove();
        } else {
            $('.flight-search .search-form-return').hide();
            $('.have-to-clone').hide();
            $('.another-item').remove();
        }
    });


    // search selected date
    const today = new Date();
    var journeyDate = new Date(),
        returnDate = new Date();

    journeyDate.setDate(today.getDate() + 1);
    returnDate.setDate(today.getDate() + 2);

    $(".journey-date").val(journeyDate.toLocaleDateString());
    $(".return-date").val(returnDate.toLocaleDateString());

    $(".journey-day-name").html(journeyDate.toLocaleString('en-us', { weekday: 'long' }));
    $(".return-day-name").html(returnDate.toLocaleString('en-us', { weekday: 'long' }));

    $(".journey-date").change(function () {
        var ojd = $(this).closest(".search-form-date").find(".journey-date").val();
        const journeyDayName = new Date(ojd).toLocaleString('en-us', { weekday: 'long' });
        $(this).closest(".search-form-date").find(".journey-day-name").html(journeyDayName);
    });

    $(".return-date").change(function () {
        var rd = $(this).closest(".search-form-date").find(".return-date").val();
        const returnDayName = new Date(rd).toLocaleString('en-us', { weekday: 'long' });
        $(this).closest(".search-form-date").find(".return-day-name").html(returnDayName);
    });



    // passenger box dropdown
    $(".passenger-box .dropdown-menu").click(function (e) {
        e.stopPropagation();
    });

    $(".passenger-class-info input[type='radio']").change(function (e) {
        var pcn = $(e.target).closest(".form-check").find("input[type='radio']:checked").val();
        $(e.target).closest(".passenger-box").find(".passenger-class-name").html(pcn);
    });

    $(".plus-btn").on("click", function (e) {
        var i = $(this).closest(".passenger-qty").children(".qty-amount").get(0).value++,
            c = $(this).closest(".passenger-qty").children(".minus-btn");

        i >= 0 && c.removeAttr("disabled");
        totalPessenger(e);
        totalRoom(e);
    }),
        $(".minus-btn").on("click", function (e) {
            var i = $(this).closest(".passenger-qty").children(".qty-amount").get(0).value;

            if (i <= 1) {
                $(this).attr("disabled", "disabled");
            } else {
                $(this).closest(".passenger-qty").children(".qty-amount").get(0).value--;
                totalPessenger(e);
                totalRoom(e);
            }
        })

    function totalPessenger(e) {
        var pa = parseInt($(e.target).closest(".passenger-box").find(".passenger-adult").val());
        var pc = parseInt($(e.target).closest(".passenger-box").find(".passenger-children").val());
        var pi = parseInt($(e.target).closest(".passenger-box").find(".passenger-infant").val());
        var tp = pa + pc + pi;
        $(e.target).closest(".passenger-box").find(".passenger-total-amount").html(tp);
    }

    function totalRoom(e) {
        var tr = parseInt($(e.target).closest(".passenger-box").find(".passenger-room").val())
        $(e.target).closest(".passenger-box").find(".passenger-total-room").html(tr);
    }



    // search multicity form
    $(".multicity-btn").click(function () {

        if (document.querySelectorAll('.flight-search-item').length === 5) {
            return alert("Maximum Flight Limit Reached!!");
        }

        $('.flight-multicity-item .date-picker').datepicker('destroy');

        var cloneMulticity = $(".have-to-clone").clone();
        cloneMulticity.removeClass("have-to-clone");
        cloneMulticity.addClass("another-item");

        cloneMulticity.find(".multicity-btn").addClass("multicity-item-remove").html(`<div>
        <i class="fal fa-circle-xmark"></i> Remove Flight</div>`);
        $(".flight-search-content").append(cloneMulticity);

        var i = 0;
        $('.flight-multicity-item .date-picker').each(function () {
            $(this).attr("id", 'date' + i).datepicker();
            i++;
        });

    });

    $(document).on('click', '.multicity-item-remove', function () {
        $(this).parent().closest('.flight-multicity-item').remove();
    });

    $(document).on('change', '.flight-multicity-item .date-picker', function (e) {
        var jd = $(e.target).val();
        const journeyDayName = new Date(jd).toLocaleString('en-us', { weekday: 'long' });
        $(e.target).closest(".flight-multicity-item").find('.journey-day-name').html(journeyDayName);
    });


    // swap search form value
    $(document).on('click', '.flight-search-item .search-form-swap', function (e) {
        var swapFrom = $(e.target).closest(".flight-search-item").find('.swap-from').val();
        var swapTo = $(e.target).closest(".flight-search-item").find('.swap-to').val();
        $(e.target).closest(".flight-search-item").find('.swap-from').val(swapTo);
        $(e.target).closest(".flight-search-item").find('.swap-to').val(swapFrom);
    });


})(jQuery);










