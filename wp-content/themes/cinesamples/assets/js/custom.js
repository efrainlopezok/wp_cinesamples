jQuery(document).ready(function ($) {
   if ($(".page-hero-item .overlay")[0] && $("body").hasClass("move-to-up")) {
      $('.slick-initialized .slick-track > .page-hero-item:first-child .overlay').clone().prependTo(".move-to-up .site-inner");
   }

   // Change color Home slide 
   $('.page-hero').on('afterChange', function() {
      var data_style = $('.slick-current .overlay').attr("style");    
      var data_style = data_style.split('#');
      $('.home .site-inner .overlay').css('background-color','#'+data_style['1']);
  });

});