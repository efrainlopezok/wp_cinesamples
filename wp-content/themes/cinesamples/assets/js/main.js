jQuery(document).ready(function($) {
    $('.search.menu-item a').on('click', function(e) {
        e.preventDefault();
        $('#seach-form').show(200);
    });
    $('a.close-search-f').on('click', function(e) {
        e.preventDefault();
        $('#seach-form').hide(200);
    });
    /* Slick slider configuration */

    if ($('.page-hero-item').length > 1) {

        $('.page-hero').slick({

            slidesToShow: 1,

            slidesToScroll: 1,

            arrows: false,

            dots: true,

            centerMode: false,

            focusOnSelect: false,

            infinite: false

        });

    }

    $('.form-support .file-cinesamples .gfield_description').on('click', function() {
        $(this).parent().find('.ginput_container_fileupload input').trigger('click');
    });

    $('.group-field').wrapAll('<div class="content-grouped"></div>');

    $('.left-g').wrapAll('<div class="left-grouped"></div>');

    $('.slide-product-cat').slick({

        slidesToShow: 5,

        slidesToScroll: 1,

        arrows: true,

        centerMode: false,
        variableWidth: true,
        //focusOnSelect: true,

        centerPadding: '0',

        infinite: false,

        responsive: [

            {

                breakpoint: 1100,

                settings: {

                    slidesToShow: 2,

                    slidesToScroll: 1,

                }

            },

            {

                breakpoint: 600,

                settings: {

                    slidesToShow: 2,

                    slidesToScroll: 2

                }

            },

            {

                breakpoint: 480,

                settings: {

                    slidesToShow: 1,

                    slidesToScroll: 1

                }

            }

            // You can unslick at a given breakpoint now by adding:

            // settings: "unslick"

            // instead of a settings object

        ]

    });



    if (window.innerWidth < 992) {

        callSliderMobile();



    }

    if (window.innerWidth < 768) {

        callAccordion();

    }

    $(window).resize(function(e) {

        if (window.innerWidth < 992) {

            callSliderMobile();

        } else {

            if ($('.block-boxes .row.no-gutters').hasClass('slick-initialized')) {

                $('.block-boxes .row.no-gutters').slick('unslick');

            }

            if ($('.blog .row').hasClass('slick-initialized')) {

                $('.blog .row').slick('unslick');

            }

        }

        if (window.innerWidth < 768) {

            callAccordion();

        } else {

            jQuery('.footer-widgets .widget_nav_menu .widgettitle').next().css('display', 'block');

        }

    });



    jQuery(window).scroll(function() {

        var sticky = jQuery(".site-header"),

            scroll = jQuery(window).scrollTop();



        if (scroll >= 200) sticky.addClass("fixed");

        else sticky.removeClass("fixed");

    });



    /* Accordion configuration */

    var allPanels = $(".accordion > .accordion-content").hide();



    $(".accordion > .accordion-title > a").click(function() {

        allPanels.slideUp();

        $(this).parent().next().slideDown();

        return false;

    });



    $(".accordion > .accordion-title > a").click(function() {

        $(".accordion > .accordion-title > a").removeClass("active");

        $(this).toggleClass("active");

    });



    $('.open-video-popup').magnificPopup({

        type: 'inline',

        midClick: true,

        callbacks: {

            open: function() {

                var videoUrl = jQuery(this.currItem.src).attr('data-url');

                console.log(videoUrl);

                if (videoUrl) {

                    jQuery(this.currItem.src).find('.video-wrap iframe').attr('src', videoUrl);

                    jQuery(this.currItem.src).find('.video-wrap').addClass('video-on')

                }

            },

        }

    });





    // $(document).ready(function() {

    //     $('.item-preview .play-btn').magnificPopup({

    //         type: 'iframe',

    //         mainClass: 'mfp-fade',

    //         preloader: true,

    //     });

    // });



    $('.filter-results .row.mobile').slick({

        slidesToShow: 1,

        slidesToScroll: 1,

        dots: false,

        centerMode: true,

        focusOnSelect: false,

        infinite: false,

        prevArrow: '.btn-slick-prev',

        nextArrow: '.btn-slick-next',

    });







});

jQuery(document).ready(function() {

    jQuery('.menu-mobile').click(function() {

        console.log('asdasdasd');

        setTimeout(function() {

            jQuery('.sfm-rollback .sfm-navicon-button').trigger("click");

        }, 300);



    });

    jQuery('.filter-nav li').click(function(e) {

        e.preventDefault();

        jQuery('.filter-nav li').removeClass('active');

        jQuery(this).addClass('active')

        var data_slug = jQuery(this).attr('data-slug');

        jQuery.ajax({

            url: ajax_object.ajax_url,

            type: 'post',

            data: {

                'action': 'cine_list_filter_ajax',

                'data_slug': data_slug,

            },

            success: function(response) {

                jQuery('.filter-results').empty().append(response);

            },

            error: function(errorThrown) {

                alert(errorThrown);

            }

        });

    });

    jQuery('.separator-members .item-member').on('click', function() {

        var item_id = jQuery(this).attr('member-id');

        jQuery('.result-content-team-member').html('');

        jQuery(this).parent().nextAll('div:first').addClass('to-show');

        jQuery('.separator-members .item-member').addClass('disabled');

        jQuery('.separator-members .item-member').removeClass('current');

        var current = jQuery(this);

        jQuery.ajax({

            url: ajax_object.ajax_url,

            type: 'post',

            data: {

                'action': 'detail_member',

                'member_id': item_id,

            },

            success: function(response) {

                current.addClass('current');

                current.removeClass('disabled');

                jQuery('.result-content-team-member.to-show').append('<a class="close-dsc">×</a>' + response);

                jQuery('.result-content-team-member').removeClass('to-show');

            },

            error: function(errorThrown) {

                alert(errorThrown);

            }

        });

    });

    jQuery('.separator-members .item-member.item-grid').on('click', function () {

        var item_id = jQuery(this).attr('video-id');

        jQuery('.result-content-team-member').html('');

        jQuery(this).parent().nextAll('div:first').addClass('to-show');

        jQuery('.separator-members .item-member.item-grid').addClass('disabled');

        jQuery('.separator-members .item-member.item-grid').removeClass('current');

        var current = jQuery(this);

        jQuery.ajax({

            url: ajax_object.ajax_url,

            type: 'post',

            data: {

                'action': 'grid_video',

                'video_id': item_id,

            },

            success: function (response) {

                current.addClass('current');

                current.removeClass('disabled');

                jQuery('.result-content-team-member.to-show').append('<a class="close-dsc">×</a>' + response);

                jQuery('.result-content-team-member').removeClass('to-show');

            },

            error: function (errorThrown) {

                alert(errorThrown);

            }

        });

    });

    jQuery('a.close-dsc').live('click', function(e) {

        e.preventDefault();

        jQuery('.separator-members .item-member.item-grid').removeClass('disabled');

        jQuery('.separator-members .item-member.item-grid').removeClass('current');

        jQuery('.result-content-team-member').html('');

    });

});

function callSliderMobile() {

    jQuery(".block-boxes .row.no-gutters").slick({

        slidesToShow: 2,

        slidesToScroll: 1,

        infinite: true,

        dots: false,

        responsive: [{

            breakpoint: 768,

            settings: {

                slidesToShow: 1,

                slidesToScroll: 1,

                infinite: true,

                dots: false,

            },

        }]



    });

    jQuery(".blog .row").slick({

        slidesToShow: 1,

        slidesToScroll: 1,

        infinite: true,

        dots: false,



    });

}



function callAccordion() {

    jQuery('.footer-widgets .widget_nav_menu .widgettitle').next().css('display', 'none');

    jQuery('.footer-widgets .widget_nav_menu .widgettitle').on('click', function() {

        var $menuTitle = jQuery(this);

        jQuery(this).next().slideToggle('fast', function() {

            $menuTitle.toggleClass('icon-active');

        });

    });

}