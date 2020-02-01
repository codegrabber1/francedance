jQuery(document).ready(function($){
    // $(window).scroll(function(){
    //     if ($(window).scrollTop() >= 200) {
    //         $('.site-header').addClass('sticky');
    //
    //     }
    //     else {
    //         $('.site-header').removeClass('sticky');
    //
    //     }
    // });
    // init Masonry
    let $grid = $(".grid");
    $grid.masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: '.grid-sizer',
        resize: true
    });
    // layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });
    
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        margin: 0,
        center: true,
        dots: false
    });

    // top menu
    $(".sf-menu").superfish();
    $(".sf-menu").after("<div id='my-menu'>");
    $(".sf-menu").clone().appendTo("#my-menu");
    $("#my-menu").find("*").attr('style', '');
    $("#my-menu").find("ul").removeClass("sf-menu");
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
        var mmAPI = $("#my-menu").data("mmenu");
        mmAPI.open();
        var thiss = $(this).find(".toggle-mnu");
        mmAPI.bind("open:finish", function(){
            thiss.addClass("on");
        });

        mmAPI.bind("close:finish", function(){
            thiss.removeClass("on");
        });

        $(".main-mnu").slideToggle();
        return false;
    }); // end top menu.


});// end of ready.


window.onload = function () {
    let box = document.getElementById('content-box');
    box.style.height = (window.innerHeight - document.getElementById('top').offsetHeight) + "px";
};