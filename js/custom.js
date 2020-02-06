jQuery(document).ready(function($){

    $("#aniimated-thumbnials").lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,
        selector: 'a'
    });
    // init Masonry
    let $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: '.grid-sizer',
        resize: true
    });
// layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });
    let config = {
        
        selectors: {
            target: '.grid-item'
        }
    };
    // gallery filter activation
    if($('#image-gallery').length){
        $('#image-gallery').mixItUp(config);
    }
    // gallery filter activation
    // $('#image-gallery').mixItUp(config);

    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        margin: 0,
        center: true,
        dots: false
    });

    // top menu on pages.
    // $(".inline-menu").superfish();
    // $(".inline-menu").after("<div id='page-menu'>");
    // $(".inline-menu").clone().appendTo("#page-menu");
    // $("#page-menu").find("*").attr("style", "");
    // $("#page-menu").find("ul").removeClass("inline-menu");
    // $("#page-menu").mmenu({
    //     extensions: ["widescreen", "pagedim-black","effect-menu-slide", "effect-listitems-slide", "fx-menu-zoom", "fx-panels-zoom", "theme-dark"],
    //     navbar: {
    //         title: "Battle BAD"
    //     }
    // });
    // let apis = $("#page-menu").data("mmenu");
    // apis.bind("closed", function(){
    //     $(".toggle-mnu").removeClass("on");
    // });
    //
    // $(".mobile-mnu").click(function() {
    //     let mmAPI = $("#page-menu").data("mmenu");
    //     mmAPI.open();
    //     let span = $(this).find(".toggle-mnu");
    //     mmAPI.bind("open:finish", function(){
    //         span.addClass("on");
    //     });
    //
    //     mmAPI.bind("close:finish", function(){
    //         span.removeClass("on");
    //     });
    //
    //     $(".main-mnu").slideToggle();
    //     return false;
    // }); // top menu on pages.


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

