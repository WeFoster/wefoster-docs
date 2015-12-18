//# sourceMappingURL=jquery.nanoscroller.js.map

//Custom Code
jQuery(document).ready(function() {

  jQuery('.inner-sidebar').removeClass('js-flash');


  //Close off canvas navigation when user clicks activity tab
  jQuery('.sidebar-offcanvas .toc_widget_list a').click(function() {
    jQuery('.row-offcanvas').delay(0).queue(function() {
      jQuery(this).toggleClass('active').clearQueue();
    });
  });


  //Ajax FaceWP Goodness
  jQuery(window).bind("load", function() {

    jQuery(document).on('facetwp-loaded', function() {
      jQuery('html, body').animate({
        scrollTop: jQuery('.main').offset().top - 400
      }, 500);

      AAPL_loadPageInit("");

    });

    jQuery(document).on('facetwp-refresh', function() {
      jQuery('.facetwp-template').prepend(
        '<div class="loading-tricks"><div class="loading-spinner"><i class="fa fa-spinner fa-pulse"></i></div></div>');
    });
  });

  jQuery(document).on('facetwp-loaded', function() {
    jQuery(".loading-tricks").remove();
  });






  function setHeight() {
    windowHeight = jQuery(window).innerHeight();
    jQuery('.inner-sidebar').css('min-height', windowHeight);
  };
  setHeight();

  jQuery(window).resize(function() {
    setHeight();
  });
});