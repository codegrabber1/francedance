jQuery(document).ready(function($){

    // gallery filter.
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
    $('.grid').mixItUp(config);
    
    $("#aniimated-thumbnials").lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,
        selector: 'a'
    });

    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        margin: 0,
        center: true,
        dots: false
    });

    // sidebar menu
    $("#primary-menu").superfish();
    $("#primary-menu").after("<div id='my-menu'>");
    $("#primary-menu").clone().appendTo("#my-menu");
    $("#my-menu").find("*").attr('style', '');
    $("#my-menu").find("ul").removeClass("sf-menu");
    $("#my-menu").find("ul").removeClass("inline-menu");
    $("#my-menu").mmenu({
        extensions: ["widescreen", "pagedim-black","effect-menu-slide", "effect-listitems-slide", "fx-menu-zoom", "fx-panels-zoom", "theme-dark"],
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

    
});// end of ready.

