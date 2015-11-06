/*!
 * Start Bootstrap - Creative Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Initialize WOW.js Scrolling Animations
    new WOW().init();

    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

    function resizeComments() {
        $("#comments-col").outerHeight($("#photo-to-show").outerHeight(true));
        $("#action-comments-box").outerHeight($("#comments-box").outerHeight(true) - $("#title-comments-box").outerHeight(true));
        $("#list-comments-box").outerHeight($("#action-comments-box").outerHeight(true) - 70);
    };

    resizeComments();

    $(window).resize(function() {  
        resizeComments();
    });

})(jQuery); // End of use strict
