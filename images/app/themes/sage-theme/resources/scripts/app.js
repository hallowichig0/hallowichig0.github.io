/**
 * External Dependencies
 */
import { domReady } from '@roots/sage/client';
import smoothscroll from 'smoothscroll-polyfill';
import 'bootstrap'
// import 'lazysizes/plugins/unveilhooks/ls.unveilhooks';
// import 'lazysizes/lazysizes';
// import 'aos/dist/aos';
// import 'mmenu-js/dist/mmenu';
import { library, dom, config } from '@fortawesome/fontawesome-svg-core';
config.autoAddCss = false;
config.autoReplaceSvg = 'nest';
config.searchPseudoElements = false;
import { faFacebookF, faTwitter, faInstagram } from '@fortawesome/free-brands-svg-icons';

/**
 * Local Dependencies
 */
async function localImports($status) {
  if($status === 'ready') {
    // Render on page document ready
    if(document.querySelectorAll('.home').length) {
      const homepath = await import('./front.js');
      homepath.default();
    }else if(document.querySelectorAll('.blog').length) {
      const postpath = await import('./blog.js');
      postpath.default();
    }
  }else if($status == 'load') {
    // Render on page load
  }
}

const triggerLoading = () => {
  $('.loader').fadeTo(400, 0);
  $('header.header').fadeTo(400, 1);
  $('main.main-wrapper').fadeTo(400, 1);
  $('footer.footer').fadeTo(400, 1);
  $('.pre-loader').hide();
}

// Hide show back to top links.
const backToTop = (el) => {
  if (window.pageYOffset > 300) {
    $(el).fadeIn();
  } else {
    $(el).fadeOut();
  }

  document.querySelectorAll(el).forEach(function(element, index) {
    element.addEventListener('click', function() {
      window.scroll({ top: 0, left: 0, behavior: 'smooth' });
    }, { once: true });
  });
};

// app.main
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }
  
  // application code
  smoothscroll.polyfill(); // kick off the polyfill!

  // how to import slick carousel from plugins.js
  // (async() => {
  //   const slickOption = {
  //     selector: '.carousel',
  //     lightbox: true,
  //   }
  //   const plugin = await import('./plugins.js');
  //   plugin.slickSlider(slickOption);
  // })();

  localImports('ready');

  // CF7 validation events for changing response CSS classes
  // document.addEventListener( 'wpcf7invalid', function( event ) {
  //   $('.wpcf7-response-output').addClass('alert alert-danger');
  // }, false );
  // document.addEventListener( 'wpcf7spam', function( event ) {
  //   $('.wpcf7-response-output').addClass('alert alert-warning');
  // }, false );
  // document.addEventListener( 'wpcf7mailfailed', function( event ) {
  //   $('.wpcf7-response-output').addClass('alert alert-warning');
  // }, false );
  // document.addEventListener( 'wpcf7mailsent', function( event ) {
  //   $('.wpcf7-response-output').addClass('alert alert-success');
  // }, false );
  
  window.addEventListener('scroll', function() {
    var headerHeight = $('.nav-top').outerHeight();
    if($(document).scrollTop() > headerHeight){
      // console.log("fixed");
      $('.nav-bottom').addClass('sticky-header');
      $('.header').addClass('sticky-header-top');
    }else{
      // console.log("remove fixed");
      $('.nav-bottom').removeClass('sticky-header');
      $('.header').removeClass('sticky-header-top');
    }
    backToTop('#back2top');
  });
  
  // window.addEventListener('resize', function(event) {
    
  // }, true);
};

domReady(main);

window.addEventListener('load', function () {
  triggerLoading();

  backToTop('#back2top');
}, false);

library.add(faFacebookF, faTwitter, faInstagram);
dom.watch();

import.meta.webpackHot?.accept(main);