require('./bootstrap');

$(document).ready(function () {
    $(".flash-message-close").click(function () {
        $(".new-flash-message").hide();
    });

    //MENU START
    $(".menuToggle").click(function () {
        var this_id = $(this).attr("data-id");

        let currentSubMenu = $("#subMenu-" + this_id);
        if (currentSubMenu.css('display') !== 'block') {
            currentSubMenu.show();
        } else {
            currentSubMenu.hide();
        }
    })
    
    $(document).mouseup(function(e) {
        var container = $(".subMenu");
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
            $("#lang-menu").hide();
            $("#user-menu").hide();
        }
    });

    $(".mobileMenuOpen").click(function () {
        $(".mobileMenu").show();
    })

    $(".mobileMenuClose").click(function () {
        $(".mobileMenu").hide();
    })

    //MENU END

    // Language START
    $("#menu-button").click(function () {
        $("#lang-menu").toggle();
    })
    // Language END
    
    // Profile START
    $("#user-menu-button").click(function () {
        $("#user-menu").toggle();
    })
    // Profile END

    $("#main-user").click(function () {
        $(".custom-mobile-menu").hide();
        $('.custom-submenu').hide();
        $(".custom-mobile-submenu").hide();
    });

    $(".custom-menu-icon").click(function () {
        $(".custom-mobile-menu").toggle();
        $('.custom-submenu').hide();
        $(".custom-mobile-submenu").hide();
    });

    $(".custom-parent-link").click(function () {

        $(".custom-mobile-menu").hide();

        if ($(this).next().is(':visible')) {
            $('.custom-submenu').hide();
        } else {
            $(".all-site").show();
            $(".all-site").css('background-color', 'transparent');
            $('.custom-submenu').hide();
            $(this).next().show();
        }

    });


    $(".custom-mobile-menu-parent-link").click(function () {

        $(".custom-submenu").hide();

        if ($(this).next().is(':visible')) {
            $('.custom-mobile-submenu').hide();
        } else {
            $('.custom-mobile-submenu').hide();
            $(this).next().show();
        }

    });

    $('.faq-list .question').click( function(){
		$(this).parent().find('.answer').slideToggle('fast');
		$(this).toggleClass('on');
		$(this).find('i').toggleClass('fas fa-sort-up');
		$(this).find('i').toggleClass('fas fa-sort-down');
		return false;
	});




});