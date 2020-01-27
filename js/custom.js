jQuery(document).ready(function($){
    $("#mainpage").fullpage({
        fitToSection: true,
        normalScrollElements: '.scrollable-content'
    });

    $.fn.fullpage.setAllowScrolling(false);

});// end of ready.