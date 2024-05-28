import VenoBox from 'venobox';

export function slickSlider(options) {
  var selector = options.selector || '.slick-carousel';
  var dots = options.dots || false;
  var arrows = options.arrows || false;
  var autoplay = options.autoplay || false;
  var autoplaySpeed = options.autoplaySpeed || 8000;
  var lightbox = options.lightbox || false;
  var lightboxOverlayColor = options.lightboxOverlayColor || 'rgba(0, 0, 0, 0.6)';
  
  $(selector).slick({
    dots: dots,
    arrows: arrows,
    infinite: true,
    autoplay: autoplay,
    autoplaySpeed: autoplaySpeed,
    speed: 1000,
    slidesPerRow: 1,
    rows: 1,
    adaptiveHeight: false,
    useTransform: false,
    pauseOnHover:false,
    pauseOnFocus: false,
    pauseOnDotsHover: false,
    fade: true,
    // lazyLoad: 'ondemand',
    accessibility: false
  }).on('init', function(event, slick, currentSlide, nextSlide){
    // for ajax scroll - autoplay after re initialize slick
    $(this).each(function(){
      var parent = $(this);
      parent.slick('slickPlay');
    });
  }).on('afterChange', function(event, slick, currentSlide, nextSlide){
    $(this).each(function(){
      var current_slick = $(this).find('.slick-active');
      var slick_img = $(this).find('.slick-active .slick-image');
      var slick_img_clone = $(this).find('.slick-cloned .slick-image');
      var parent = $(this);

      // add lazyload class for each slick active
      if(!slick_img.hasClass('lazyloaded')){
        slick_img.addClass('lazyload');
      }

      // cloned add lazyload class
      if(!slick_img_clone.hasClass('lazyloaded')){
        slick_img_clone.addClass('lazyload');
      }

      if(slick_img.hasClass('lazyloaded')){
        parent.slick('slickPlay');
      }else{
        parent.slick('slickPause');
      }
      
      slick_img.on('lazyloaded', function(){
        current_slick.removeClass('slick-hide');
        if(this.complete){
          parent.slick('slickPlay');
          slick_img.addClass('completed');
        }else{
          parent.slick('slickPause');
        }
      });
    });
  });

  // Off autoplay on initial load. On autoplay after image has been lazyloaded.
  $(selector).each(function(){
    var parent = $(this);
    var current_slick = $(this).find('.slick-active');
    var slick_img = $(this).find('.slick-active .slick-image');

    slick_img.addClass('lazyload');

    slick_img.on('lazyloaded', function(){
      slick_img.addClass('completed');
      current_slick.removeClass('slick-hide');
      parent.slick('slickPlay');
    });

    // enable lightbox (make sure you put slick-lightbox class to your <a> tag)
    if(lightbox === true) {
      var lightboxSelector = '.slick-lightbox';
      var venoOptions = {
        // Options
        selector: lightboxSelector,
        overlayColor: lightboxOverlayColor,
        spinner: 'cube-grid',
        // Callbacks
        onPreOpen : function(obj){ // is called before the venobox pops up, return false to prevent opening;
          parent.slick('slickPause');
        },
        onPreClose : function(obj, gallIndex, thenext, theprev){ // is called before closing, return false to prevent closing
          parent.slick('slickPlay');
        },
      };
      new VenoBox(venoOptions);
    }
  });
}