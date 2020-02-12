jQuery(document).ready(function($){

    // gallery mixing and filter.
    let config = {
        selectors: {
            target: '.grid-item',
            filter: '.filter',
        },
        animation: {
            animateResizeContainer: false,
            effects: 'fade scale'
        }
    };
    $('.grid').mixItUp(config);  // End of gallery mixing and filter.
    
    // Light gallery.
    $("#aniimated-thumbnials").lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,
        selector: 'a',
        youtubePlayerParams: { modestbranding: 1, showinfo: 0, controls: 0 }
    }); // End of Light gallery.

    // Big carousel on the home page.
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        margin: 0,
        center: true,
        dots: false
    });

    // Sidebar menu and top menu.
    $("#primary-menu").superfish();
    $("#primary-menu").after("<div id='my-menu'>");
    $("#primary-menu").clone().appendTo("#my-menu");
    $("#my-menu").find("*").attr('style', '');
    $("#my-menu").find("ul").removeClass("sf-menu");
    $("#my-menu").find("ul").removeClass("inline-menu");
    $("#my-menu").mmenu({
        extensions: [
            "widescreen",
            "pagedim-black",
            "effect-menu-slide",
            "effect-listitems-slide",
            "fx-menu-zoom",
            "fx-panels-zoom",
            "theme-dark"],
        navbar: {
            title: "Battle BAD"
        }
    });
    let api = $("#my-menu").data("mmenu");
    api.bind("closed", function() {
        $(".toggle-mnu").removeClass("on");
    });

    $(".mobile-mnu").click(function() {
        let mmAPI = $("#my-menu").data("mmenu");
        mmAPI.open();
        let thiss = $(this).find(".toggle-mnu");
        mmAPI.bind("open:finish", function(){
            thiss.addClass("on");
        });

        mmAPI.bind("close:finish", function(){
            thiss.removeClass("on");
        });

        $(".main-mnu").slideToggle();
        return false;
    }); // end sidebar menu.

    // Button to pick up to top of the page.
    $(function () {
        $(window).scroll(function () {

            if ($(this).scrollTop() != 0) {

                $('#toTop').fadeIn();

            } else {

                $('#toTop').fadeOut();

            }

        });

        $('#toTop').click(function () {

            $('body,html').animate({scrollTop: 0}, 800);

        });

    }); // End of Button to pick up to top of the page.
});// end of ready.

