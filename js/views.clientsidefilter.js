(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.clientsideFilter = {
    attach: function (context, settings) {
      $("input[value='All']").closest('label').addClass('active');
      $('input[type=radio]', 'div.view-rental-items').change(
        function(){
            if (this.checked) {
              selected = $(this).closest('label').text().replace(/[\s\xA0]+/g,'-').toLowerCase();  // get class name from input label
              slider = $(this).parents('.view-rental-items').find('.slick-slider')
              
              // Assign active class to checked label
              $(this).parents('.view-rental-items').find('label').removeClass('active');
              $(this).closest('label').addClass('active');

              if(selected == 'all'){  // check if all slides should be displayed
                slider.slick('slickUnfilter');
              } else {
                slider.slick('slickUnfilter');
                slider.slick('slickFilter', '.' + selected);  // filter out based on selected class
              }
              slider.slick('slickGoTo', 0); // reset slider to first slide
            }
      });
    }
  }

  $.fn.ajaxFilter = function(data) {
    filter = $('.exposed-parent-' + data);
    filter.find('input[type=radio]:checked').each(function() {
      selected = $(this).closest('label').text().replace(/[\s\xA0]+/g,'').toLowerCase();
      filter.parent().parent().find('div.slide').each(function() {
        $(this).show();
      });
      filter.parent().parent().find('div.slide.' + selected).each(function() {
        $(this).hide();
      });
    });
  };  
})(jQuery, Drupal, drupalSettings);