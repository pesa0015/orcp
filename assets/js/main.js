/**
 * Global Variables
 *
 * Variables in the object "orcp" are fetched from the scripts-style.php
 * file through WordPress's localization method.
 */

// Set the Active Project Number
var activeProjectNumber = parseInt(orcp.activeProjectNumber);

// Set the maximum project number
var maxProjectNumber = parseInt(orcp.maxProjectNumber);

// Load Foundation
jQuery(document).foundation();

function isMobile() {
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) 
        return true;
    return false;
}

var mobile = isMobile();

// jQuery('#section-intro').swipebox({
//     initialIndexOnArray: 1,
//     beforeOpen: function() {
//         // if (jQuery('.swipebox').hasClass('product-slide')) {
//         //     jQuery('.product-slide').removeClass('.swipebox');
//         //     console.log(jQuery('.swipebox'));
//         // }

//         jQuery('.product-slide').attr('class', 'product-slide');

//         // console.log(jQuery('.swipebox'));
//     },
//     // afterClose: function() {
//         // console.log(1);
//     // }
//     afterOpen: function() {
//         // setTimeout(function(){
//         //     var name = '.slide.current';
//         //     // console.log(jQuery(name).next().children()[0].src);
//         //     // console.log(jQuery('.slide.current').children());
//         //     var firstImage = jQuery(name).children()[0].src;
//         //     var secondImage = jQuery(name).next().children()[0].src;
//         //     if (firstImage === secondImage) {
//         //         jQuery(name).next().remove();
//         //         // console.log(jQuery(name).next());
//         //     }
//         // }, 1010);
//     }
// });
if (document.contains(document.getElementById('section-intro'))) {
  document.getElementById('section-intro').onclick = function(e) {
    jQuery('.product-slide').attr('class', 'product-slide');
    setTimeout(function(){
        document.getElementById('swipebox-close').onclick = function() {
            jQuery('.product-slide').addClass('swipebox');
        };
    }, 100);
    // jQuery('.product-slide').attr('class', 'product-slide');
    //     var firstImage = jQuery('.slide.floating-illusions.current').children()[0].src;
    //     var secondImage = jQuery('.slide.floating-illusions.current').next().children()[0].src;
    //     if (firstImage === secondImage) {
    //         jQuery('.slide.floating-illusions.current').next().remove();
    //     }
  };
}
    // if (!mobile)
    //     return false;

    // setTimeout(function() {
    //     jQuery('html, body').animate({
    //         scrollTop: jQuery('#section-menu').offset().top - 100 + 'px'
    //     }, 1000);
    // }, 100);

    // jQuery('.footer-details-logo img').click(function(e) {
        
    // e.preventDefault();

    // var customText = '<section class="split-screen-container custom-menu-container">
    //   <div class="split-screen-left custom-menu-left fp-section fp-table" style="width: 100%;">' + jQuery('#section-menu').html() + '</div>
    //   <div class="split-screen-right custom-menu-wrapper">
    //     <div class="split-screen-body custom-menu">
    //       <div class="split-screen-close custom-menu-close">
    //           <a href="#" class="close-button"><img src="' + orcp.themeurl + '/assets/images/flex/close-button.svg" width="36" height="36" alt="Close"></a>
    //       </div>
    //     </div>
    //   </div>
    // </section>';

    // jQuery('body').append(customText);

    // var windowHeight = jQuery(window).height();

    // jQuery('.custom-menu-container').css('height', windowHeight);
    // jQuery('.custom-menu-wrapper').css('height', windowHeight);

    // // Set the height of the pixels to the height of the facts box
    // var boxHeight = jQuery('.custom-menu-container').height();
    // jQuery('.custom-menu-left').height( boxHeight );

    // // Toggle the facts box
    // jQuery('.custom-menu-container').slideToggle();

    // /* Close on close button click */
    // jQuery('.custom-menu-close a').click(function(e) {
    //   e.preventDefault();
    //   // console.log(1);
    //   jQuery('.custom-menu-container').slideToggle();
    //   jQuery('#section-menu').show();
    // });

    // jQuery('.custom-menu-container .nav-section-item a').click(function() {
    //     jQuery('.custom-menu-container').hide();
    //     jQuery('#section-menu').show();
    // });

    // jQuery('.split-screen-container').css('background-color', 'rgba(255,255,255,0.5)');
    // jQuery('#section-menu').hide();
// }

/**
 * jQuery Fullpage
 */
 jQuery(document).ready(function() {
  jQuery('#fullpage').fullpage({
    fixedElements: '.site-header, #introduction, .product-item-facts-box, .split-screen-container',
    verticalCentered: true,
    scrollOverflow: false,
    fitToSection: true,
    scrollBar: true,
    autoScrolling: false,
    controlArrows: false,
    paddingTop: '5rem',
    paddingBottom: '4rem',
    afterLoad: function(anchorLink, index) {

      var loadedSection = jQuery(this);

      // Make sure we set the height to be AT LEAST the window height
      // var innerHeight = jQuery(loadedSection).find('.section-inner').height();

      // if ( innerHeight > loadedSection.height() ) {
      //   jQuery(loadedSection).height(innerHeight);
      //   jQuery(loadedSection).find('.fp-tableCell').height(innerHeight);

      //   jQuery.fn.fullpage.reBuild();
      // }

      // When we want to use a "light" header
      if(loadedSection.data('colorscheme') == 'light'){
        jQuery('.site-header').css('opacity', '0');
        jQuery('.site-header a').css('color', '#FFFFFF');
        jQuery('.logo svg').css('fill', '#FFFFFF');
        jQuery('.store-navigation-divider svg').css('fill', '#FFFFFF');
        jQuery('.primary-navigation li').css('background-image', '#');
        jQuery('.site-header').css('opacity', '1');
      }

      // When we want to use a dark header
      if(loadedSection.data('colorscheme') == 'dark'){
        jQuery('.site-header').css('opacity', '0');
        jQuery('.site-header a').css('color', '#000000');
        jQuery('.logo svg').css('fill', '#000000');
        jQuery('.store-navigation-divider svg').css('fill', '#000000');
        jQuery('.primary-navigation li').css('background-image', '#');
        jQuery('.site-header').css('opacity', '1');
      }

      if(loadedSection.data('colorscheme') == 'custom') {
        var linkColor = loadedSection.data('headerlinkcolor');
        var logoColor = loadedSection.data('headerlogocolor');
        var menuSprite = loadedSection.data('headermenusprite');

        jQuery('.site-header').css('opacity', '0');
        jQuery('.site-header a').css('color', linkColor);
        jQuery('.logo svg').css('fill', logoColor);
        jQuery('.store-navigation-divider svg').css('fill', linkColor);
        jQuery('.primary-navigation li').css('background-image', menuSprite);
        jQuery('.site-header').css('opacity', '1');

      }

      // Should we want to hide the header completely...
      if(loadedSection.data('colorscheme') == 'none'){
        jQuery('.site-header').css('opacity', '0');
      }

      if(loadedSection.data('colorscheme') == ''){
        jQuery('.site-header').css('opacity', '0');
      }

      // Position project nav
      jQuery(loadedSection).find('.projectnav-wrapper').css('top',loadedSection.height()/2 + 'px');

      /**
       * Slide Navigation
       */
      jQuery('body').on( 'click', '.product-item-nav-trigger', function(e) {
        e.preventDefault();

        var productID = jQuery(this).data('product');
        var variationID = jQuery(this).data('variation');

        var productSectionAnchor = 'product-' + productID;

        jQuery.fn.fullpage.moveTo( productSectionAnchor, variationID );

        // if (mobile)
        //     return false;

        // setTimeout(function() {
            // jQuery('html, body').animate({
            //     scrollTop: jQuery('.slide, .product-item-color, .fp-slide, .fp-table active').offset().top + 100 + 'px'
            // }, 500);
        // }, 0);

      });

      /**
       * Fix Color Border in Chrome
       */
      // jQuery('.listings-item a').each(function() {
      //   var borderColor = jQuery(this).parents('.section').css('border-color');

      //   jQuery(this).css('border-color', borderColor);
      // });

        // if (anchorLink === 'spacer') {
        //     jQuery('html, body').animate({scrollTop: jQuery('#section-spacer').offset().top - 50 + 'px'}, 500);
        // }
      /**
       * Image Container Height
       */
      // jQuery('.product-item-images').each(function() {

      //   if (window.matchMedia('(min-width: 64em)').matches) {
      //     var imageHeight = loadedSection.height() - 60;

      //     jQuery(this).height( imageHeight );
      //     jQuery(this).find('img').css('max-height', imageHeight + 'px');
      //   }

      // });

    }
  });
 });

/**
 * Display Notice When Non-EU Country
 */
jQuery(function() {

  jQuery('select#billing_country').change(function() {

    // Get the value
    var selectVal = jQuery(this).val();

    var EUCountries = [
      'AL', 'AD', 'AM', 'AT', 'BY', 'BE', 'BA', 'BG', 'CH', 'CY', 'CZ', 'DE',
      'DK', 'EE', 'ES', 'FO', 'FI', 'FR', 'GB', 'GE', 'GI', 'GR', 'HU', 'HR',
      'IE', 'IS', 'IT', 'LT', 'LU', 'LV', 'MC', 'MK', 'MT', 'NO', 'NL', 'PL',
      'PT', 'RO', 'RU', 'SE', 'SI', 'SK', 'SM', 'TR', 'UA', 'VA'
    ];

    if(jQuery.inArray(selectVal, EUCountries) === -1) {

      var checkoutNotice = '<section class="split-screen-container checkout-notice-container">'
        + '<div class="split-screen-left bg-binary"></div>'
        + '<div class="split-screen-right checkout-notice-wrapper">'
          + '<div class="split-screen-body checkout-notice">'
            + '<div class="split-screen-close">'
                + '<a href="#" class="close-button"><img src="' + orcp.themeurl + '/assets/images/flex/close-button.svg" class="iconic" id="cart-error-close-img" width="36" height="36" alt="Close"></a>'
            + '</div>'
            + orcp.vatText
          '</div>'
        + '</div>'
      + '</section>';

      jQuery('body').append(checkoutNotice);

      var windowHeight = jQuery(window).height();

      jQuery('.checkout-notice-container').css('height', windowHeight);
      jQuery('.checkout-notice-wrapper').css('height', windowHeight);

      // Set the height of the pixels to the height of the facts box
      var boxHeight = jQuery('.checkout-notice-container').height();
      jQuery('.split-screen-left').height( boxHeight );

      // Toggle the facts box
      jQuery('.checkout-notice-container').slideToggle();

      /* Close on close button click */
      jQuery('.split-screen-close a').click(function(e) {
        e.preventDefault();
        jQuery('.checkout-notice-container').slideToggle();
      });

      /* Close on pixel grid click */
      jQuery('.split-screen-left').click(function(e) {
        e.preventDefault();
        jQuery('.checkout-notice-container').slideToggle();
      });

    }

  });

});

/**
 * jQuery Swipebox for Galleries
 */
jQuery(function() {

  jQuery('.swipebox').swipebox({
    removeBarsOnMobile: false,
    hideBarsDelay: 0,
    afterOpen: function(){
        setTimeout(function(){
            var current = jQuery('div.slide.current img:first-child');
            var img = current.attr('src');
            if (jQuery('.project-floating-illusions ul li a:contains("<a href=\"' + img + '\"></a>)').length == 1) {
                jQuery('div.slide').addClass('floating-illusions');
            }
            // var introImage = jQuery('#section-intro').attr('href');
            // var secondSlide = jQuery('.slide:contains(<img src="' + introImage + '">)');
            // console.log(secondSlide);
            // var l = jQuery('#swipebox-slider div.slide.current')[0];
            // l.remove();
            // console.log(jQuery('#swipebox-slider .slide')[0]);
        }, 100);
    },
    afterClose: function() {
        if (jQuery('div.slide').hasClass('floating-illusions')) {
            jQuery('div.slide').className = 'slide';
        }
    }
  });

});

// var headerSection = jQuery('.logo, .store-navigation');
var headerSection = jQuery('.logo');
var storeNavigation = jQuery('.store-navigation');
jQuery(headerSection).css('display', 'none');
// jQuery(storeNavigation).css('display', 'none');
// jquery(storeNavigation).removeClass('store-nav-desktop');

window.onscroll = function() {
    var section = window.location.hash;
    if (section === '' || section === '#welcome' || section === '#intro') {
        jQuery(headerSection).css('display', 'none');
        jQuery(storeNavigation).removeClass('store-nav-desktop-show');
        jQuery(storeNavigation).addClass('store-nav-desktop-hide');
    } else {
        jQuery(headerSection).css('display', 'block');
        jQuery(storeNavigation).removeClass('store-nav-desktop-hide');
        jQuery(storeNavigation).addClass('store-nav-desktop-show');
    }
};

/**
 * Mobile Navigation
 */
jQuery('#mobile-navigation-toggle').click(function(e) {
  e.preventDefault();

  jQuery('.mobile-navigation-wrapper').animate({
    left: 0
  });

  jQuery('.site-header,#fullpage').animate({
    left: '25rem',
    opacity: 0.5
  });

});

jQuery('#mobile-navigation-close').click(function(e) {
  e.preventDefault();

  jQuery('.mobile-navigation-wrapper').animate({
    left: '-26rem'
  });

  jQuery('.site-header,#fullpage').animate({
    left: '0',
    opacity: 1
  });

});

/**
 * Pre-loader
 *
 * Shows the preloader graphic with a timeout.
 * We also remove the transform class to stop the intensive
 * CSS transformation.
 */
jQuery(function() {

  window.showPreloader = function() {
    jQuery('body').removeClass('loaded');
    jQuery('#loading #spinner').addClass('transform');
  }

  window.hidePreloader = function() {

    jQuery('body').addClass('loaded');
    jQuery('#loading #spinner').removeClass('transform');

  }

});

/**
 * AJAX Add to Cart
 *
 * Custom Add to Cart feature for the products.
 */
jQuery('.product-item-actions-cart').click(function(e) {

  // Prevent default action
  e.preventDefault();

  // Get the form
  var form = jQuery(this).parents('form:first');

  // Get the Product ID
  var productId = jQuery('#product_id', form).val();

  // Get the Variation ID
  var variationId = jQuery('#variation_id', form).val();

  // Get the Color Slug
  var colorSlug = jQuery('#color_slug', form).val();

  // Get the Size
  var productSize = jQuery('#pa_size', form).val();

  // If a size isn't select, prompt the user to do so!
  if ( productSize === '' ) {

    // Add error message to body
    if ( jQuery('#cart-error').length == 0 ) {

      var errorDiv = '<section class="split-screen-container cart-error-container">'
        + '<div class="split-screen-left bg-binary"></div>'
        + '<div class="split-screen-right cart-error-wrapper">'
          + '<div class="split-screen-body cart-error">'
            + '<div class="split-screen-close">'
                + '<a href="#" class="close-button"><img src="' + orcp.themeurl + '/assets/images/flex/close-button.svg" class="iconic" id="cart-error-close-img" width="36" height="36" alt="Close"></a>'
            + '</div>'
            + '<p>Please select a size before adding the product.</p>'
          + '</div>'
        + '</div>'
      + '</section>';

      jQuery('body').append(errorDiv);

    }

    var windowHeight = jQuery(window).height();

    jQuery('.cart-error-container').css('height', windowHeight);
    jQuery('.cart-error-wrapper').css('height', windowHeight);

    // Set the height of the pixels to the height of the facts box
    var boxHeight = jQuery('.cart-error-container').height();
    jQuery('.split-screen-left').height( boxHeight );

    // Toggle the facts box
    jQuery('.cart-error-container').slideToggle();

    /* Close on close button click */
    jQuery('.split-screen-close a').click(function(e) {
      e.preventDefault();
      jQuery('.cart-error-container').slideToggle();
    });

    /* Close on pixel grid click */
    jQuery('.split-screen-left').click(function(e) {
      e.preventDefault();
      jQuery('.cart-error-container').slideToggle();
    });

  } else {

    // Do the AJAX
    jQuery.ajax({
      url: orcp.homeurl + '?add-to-cart=' + productId + '&variation_id=' + variationId + '&attribute_pa_size=' + productSize + '&attribute_pa_color=' + colorSlug,
      data: {
        "project_id": productId,
        "variation_id": variationId,
        "color_slug": colorSlug,
        "product_size": productSize,
      },
      type: 'POST',
      success: function() {

        // If we are successful, reload the page!
        location.reload();
      }
    });

  }

});

/**
 * Product Angle Click
 */
jQuery(window).load(function() {

  jQuery('.product-item-angles-item:nth-child(2) a').addClass('active');

  jQuery('.product-item-angles-item a').click(function(e) {

    e.preventDefault();

    var imgOrder = jQuery(this).data('imgorder');

    var images = jQuery(this).parents('.product-item').find('.product-item-images a');
    jQuery(images).fadeOut(0);

    var px = isMobile() ? 0 : 100;

    // setTimeout(function(){
      jQuery(images).each(function() {
        if(jQuery(this).data('imgorder') === imgOrder) {
            jQuery(this).fadeIn(0);
            if (mobile) {
                jQuery('html, body').animate({
                    scrollTop: jQuery('.product-item-images').offset().top + 0 + 'px'
                }, 500);
            }
        }
      });
    // }, 600);

    jQuery('.product-item-angles-item a').removeClass('active');
    jQuery(this).addClass('active');

  });

});

/**
 * Run Project Change on Load
 *
 * Make sure we populate all AJAX loaded sections
 * on the page load, including checking for a cookie
 * for the previously loaded project.
 */
jQuery(window).load(function() {

  // Read the project cookie
  var cookieProjectNumber = jQuery.cookie('orcp_project');

  // If we have a project stored from before, load that..
  if ( cookieProjectNumber ) {
    changeProject( cookieProjectNumber, maxProjectNumber );

  // Otherwise, we load the global active project (which should here be 1)
  } else {
    changeProject( activeProjectNumber, maxProjectNumber );
  }

});

/**
 * AJAX Section Loading Functions
 *
 * The functions here are all relevant to loading the different section
 * content for the right project through AJAX and outputting the
 * project navigation.
 */
jQuery(function() {

  /**
   * Helper function to handle the AJAX Error
   */
  function handleAjaxError(xhr, status, error){
    jQuery(".loading-animation").text("Loading failed");
  }

  /**
   * Change Project Function
   *
   * Performs all the logic involved in changing to to a new project,
   * running the necessary sub-functions etc.
   */
  window.changeProject = function(newActiveProjNo, maxProjNo){

    // Show the preloader graphic while we load...
    showPreloader();

    // Get on with the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        "action": "load-filter",
        project: newActiveProjNo
      },
      success: function() {

          // Get the books
          books_ajax_get(newActiveProjNo);

          // Get the products
          productgrid_ajax_get(newActiveProjNo);

          // Get the single products
          products_ajax_get(newActiveProjNo);

          // Get the paintings
          paintings_ajax_get(newActiveProjNo);

          // Get the grid section
          grid_section_ajax_get(newActiveProjNo);

          // Update the navigation
          updateProjectNavNo(newActiveProjNo, maxProjNo);

          // Store a cookie with the new project
          // so that we remember this for re-visiting the page.
          jQuery.cookie('orcp_project', newActiveProjNo, { expires: 7, path: '/' });

          // Hide Preloader when we are done
          setTimeout(function() {
            hidePreloader();
          }, 300);

          return false;
      },
      error:  handleAjaxError
    });
  }

  /**
   * Update the Navigation Button Numbers
   */
  window.updateProjectNavNo = function(newActiveProjNo, maxProjNo){

    // Get the active project number
    var activeProjNavNo = parseInt(newActiveProjNo);

    // Compute the previous project number
    var prevProjNo = activeProjNavNo - 1;

    // Compute the next project number
    var nextProjNo = activeProjNavNo + 1;

    // Get the max project number
    var projMaxValue = maxProjNo;

    // Show the navigation buttons
    jQuery('.projectnav-previous').show();
    jQuery('.projectnav-next').show();

    // If we are at project 1, hide the previous
    // button as there are no previous projects.
    if (activeProjNavNo == 1){
      jQuery('.projectnav-previous').hide();
    }

    // If we are at the maximum project number,
    // hide the next button as we have no more projects.
    if (activeProjNavNo == projMaxValue){
      jQuery('.projectnav-next').hide();
    }

    // Update the project navigation buttons with the numbers
    jQuery('.projectnav-previous span').html(prevProjNo);
    jQuery('.projectnav-next span').html(nextProjNo);

    // Show the whole project nav section
    // (initially hidden in CSS)
    jQuery('.projectnav-wrapper').show();

  }

  /**
   * Position Project Navigation in Vertical Middle
   */
  window.updateProjectNavPos = function(){

    jQuery.fn.fullsize = function(parent) {

      // Get the parent element
      wrapperparent = this.parent();

      // Set some CSS for the positioning
      this.css({
        "margin-top": - (parseInt(jQuery(wrapperparent).css('padding-top')) + parseInt(jQuery(wrapperparent).css('padding-bottom'))) + "px",
        "width": jQuery(wrapperparent).width() + "px",
        "height": jQuery(wrapperparent).outerHeight() + jQuery(wrapperparent).scrollTop() + "px"
      });

      return this;
    }

    // Run the positioning for each project nav on the page
    jQuery(".projectnav-wrapper").each(function() {
      jQuery( this ).fullsize(true);
    });

    // Center the items on the page
    jQuery.fn.center = function(parent) {

      // Get the parent
      parent = this.parent();

      // Set some positioning CSS
      this.css({
        "position": "absolute",
        "top": jQuery(parent).outerHeight()/2 + jQuery(this).height()/2 + jQuery(parent).scrollTop() + "px"
      });

      return this;
    }

// Run the centering for all previous buttons on the page
//    jQuery(".projectnav-previous").each(function() {
//      jQuery( this ).center(true);
//    });

//    // Run the centering for all next buttons on the page
//    jQuery(".projectnav-next").each(function() {
//      jQuery( this ).center(true);
//    });

//    // Run the centering function for the loading animation
//    jQuery(".loading-animation").each(function() {
//      jQuery( this ).center(true);
//    });

  }

  /**
   * Previous Project Nav Button Function
   */
  window.projPrevious = function(){

    // If our active project is one, make sure we can't
    // go to negative. Otherwise, we deduct one from active to
    // get the previous project.
    if(activeProjectNumber === 1) {
      newProjNo = 1;
    } else{
      newProjNo = activeProjectNumber - 1;
    }

    // Update the global variable
    activeProjectNumber = newProjNo;

    // Run the change project function
    changeProject(newProjNo, maxProjectNumber);
  }

  // Function when pressing next button
  window.projNext = function(){

    // If we are at the max project number, then make sure
    // we can't go to a project that doesn't exist.
    // Otherwise, we add one for the next project.
    if (activeProjectNumber === maxProjectNumber){
      newProjNo = activeProjectNumber;
    } else{
      newProjNo = activeProjectNumber + 1;
    }

    // Update the global active number
    activeProjectNumber = newProjNo;

    // Run the project change function
    changeProject(newProjNo, maxProjectNumber);
  }

  /**
   * Load Product Grid
   */
  window.productgrid_ajax_get = function(newActiveProjNo){

    // Run the AJAX Request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        "action": "load-filter1",
        productgrid: newActiveProjNo
      },
      success: function(productgrid) {

        // Get the products
        products_ajax_get(newActiveProjNo);

        // Hide the loading animation
        jQuery('#products-section-inner').hide().html(productgrid).fadeIn();

        jQuery.fn.fullpage.reBuild();

        setTimeout(function() {
          hidePreloader();
        }, 300);

        return false;
      },
      error:  handleAjaxError
    });
  }

  /**
   * Load Products
   */
  window.products_ajax_get = function(newActiveProjNo){

    // Do the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        "action": "load-filter2",
        products: newActiveProjNo
      },
      success: function(products) {

          // On success, we hide the loading animation and show
          // the products div.
          jQuery('#products-output').hide().html(products).fadeIn();

          setTimeout(function() {
          hidePreloader();
        }, 300);

          return false;
      },
      error:  handleAjaxError
    });
  }

  /**
   * Load Paintings Grid
   */
  window.paintings_ajax_get = function(newActiveProjNo){

    // Run the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        "action": "load-filter3",
        paintings: newActiveProjNo
      },
      success: function(paintingsgrid) {

        // Hide the loading animation on success and
        // fade in the grid.
        jQuery('#paintingsoutput').hide().html(paintingsgrid).fadeIn();

        jQuery.fn.fullpage.reBuild();

        setTimeout(function() {
          hidePreloader();
        }, 300);

        return false;
      },
      error:  handleAjaxError
    });
  }

  /**
   * Load the Books Grid
   */
  window.books_ajax_get = function(newActiveProjNo){

    // Run the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        "action": "load-filter4",
        books: newActiveProjNo
      },
      success: function(booksgrid) {

        // On success we hide the loading animation
        // and fade in the books grid.
        jQuery('#booksoutput').hide().html(booksgrid).fadeIn();

        jQuery.fn.fullpage.reBuild();

        setTimeout(function() {
          hidePreloader();
        }, 300);

        return false;
      },
      error:  handleAjaxError
    });
  }

  /**
   * Load the Grid Section
   */
  window.grid_section_ajax_get = function(newActiveProjNo){

    var colorScheme = jQuery('#grid-section').data('colorschemeid');

    // Run the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        "action": "load-grid_section",
        project: newActiveProjNo,
        colorScheme: colorScheme
      },
      success: function(grid_section) {

        var gridSection = grid_section;

        var gridSectionHeight = jQuery('#grid-section').height();

        // On success we hide the loading animation
        // and fade in the books grid.
        jQuery('#grid-output').hide().html(gridSection).fadeIn();

        jQuery('.facebook-box, .instagram-box').click(function(){
            // jQuery('html, body').animate({scrollTop: 0}, 500);
            return false;
        });

        jQuery.fn.fullpage.reBuild();

        // Set Grid Section Height
        jQuery('.grid-section-item').css( 'height', gridSectionHeight / 2 + 'px' );

        jQuery('.grid-inner').each(function() {
          var heights = jQuery(this).find('.section-title').height() + jQuery(this).find('.section-description').height();
          // var widths = jQuery(this).find('.section-title').width() + jQuery(this).find('.section-description').width();

          jQuery(this).height(heights);
          // jQuery(this).width(widths);

        });

        setTimeout(function() {
          hidePreloader();
        }, 300);

        return false;
      },
      error:  handleAjaxError
    });
  }

});

/**
 * Popup Product Facts
 */
jQuery(window).load(function() {

  // Sections
  var productFactsSections = [
    "facts",
    "size",
    "shipping",
    "returns",
    "payment",
    "contact"
  ];

  /* Open facts box */
  jQuery('.product-facts-trigger').click(function(e) {

    // Prevent default link action
    e.preventDefault();

    var windowHeight = jQuery(window).height();

    jQuery('.product-item-facts-box').css('height', windowHeight);
    jQuery('.product-item-facts-box-content').css('height', windowHeight);

    // Show the right content
    var type = jQuery(this).data('type');
    jQuery('.product-item-facts-box-content-item').hide();
    jQuery('.product-item-facts-box-content').find('#' + type).show();
    jQuery('.product-item-facts-box-content').data('active', type);

    // Set the height of the pixels to the height of the facts box
    var boxHeight = jQuery('.product-item-facts-box').height();
    jQuery('.product-item-facts-box-pixels').height( boxHeight );

    // Toggle the facts box
    if ( jQuery('.product-item-facts-box').css('display') == 'none' ) {
      jQuery('.product-item-facts-box').slideToggle();
    }

  });

  jQuery('.product-item-facts-box-arrows .prev a').click(function(e) {
    e.preventDefault();

    var activeTab = jQuery('.product-item-facts-box-content').data('active');
    var prevTab = productFactsSections[(jQuery.inArray(activeTab, productFactsSections) - 1 + productFactsSections.length) % productFactsSections.length];

    jQuery('.product-item-facts-box-content-item').hide();
    jQuery('.product-item-facts-box-content').find('#' + prevTab).show();
    jQuery('.product-item-facts-box-content').data('active', prevTab);

  });

  jQuery('.product-item-facts-box-arrows .next a').click(function(e) {
    e.preventDefault();

    var activeTab = jQuery('.product-item-facts-box-content').data('active');
    var nextTab = productFactsSections[(jQuery.inArray(activeTab, productFactsSections) + 1 + productFactsSections.length) % productFactsSections.length];

    jQuery('.product-item-facts-box-content-item').hide();
    jQuery('.product-item-facts-box-content').find('#' + nextTab).show();
    jQuery('.product-item-facts-box-content').data('active', nextTab);

  });

  /* Close on close button click */
  jQuery('.product-item-facts-box-close').click(function(e) {
    e.preventDefault();
    jQuery('.product-item-facts-box').slideToggle();
  });

  /* Close on pixel grid click */
  jQuery('.product-item-facts-box-pixels').click(function(e) {
    e.preventDefault();
    jQuery('.product-item-facts-box').slideToggle();
  });

});

/**
 * Copy Link Script
 */
// jQuery('.copy-link-trigger').click(function(e) {

//   // Prevent Default Link Action
//   e.preventDefault();

//   // Get the link
//   var link = jQuery(this).data('link');

//   // Show a prompt to copy the link
//   window.prompt("Copy to clipboard: Ctrl+C, Enter", link);

// });

/**
 * Shopping Cart Dispaly
 */
jQuery(window).load(function() {

  /* Open facts box */
  jQuery('#mini-cart-trigger').click(function(e) {

    // Prevent default link action
    e.preventDefault();

    var windowHeight = jQuery(window).height();

    jQuery('.shopping-cart-container').css('height', windowHeight);
    jQuery('.shopping-cart-wrapper').css('height', windowHeight);

    // Set the height of the pixels to the height of the facts box
    var boxHeight = jQuery('.shopping-cart-container').height();
    jQuery('.shopping-cart-pixels').height( boxHeight );

    // Toggle the facts box
    jQuery('.shopping-cart-container').slideToggle();

  });

  /* Close on close button click */
  jQuery('#mini-cart-close a').click(function(e) {
    e.preventDefault();
    jQuery('.shopping-cart-container').slideToggle();
  });

  /* Close on pixel grid click */
  jQuery('.shopping-cart-pixels').click(function(e) {
    e.preventDefault();
    jQuery('.shopping-cart-container').slideToggle();
  });

});

/**
 * Checkout
 */
jQuery(window).load(function() {

  // Checkout Button
  jQuery('#checkout-button').click(function(e) {

    // Prevent default action
    e.preventDefault();

    // Submit the checkout form
    jQuery('form.woocommerce-checkout').submit();

  })

});

/**
 * Newsletter Subscription
 */
jQuery(window).load(function() {

  jQuery('form#orcp-newsletter-subscribe').submit(function(e) {

    e.preventDefault();

    // Get email value
    var email = jQuery('#orcp-newsletter-subscribe-email').val();

    // Get nonce
    var nonce = jQuery('#newsletter_nonce').val();

    // Get on with the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        'action': 'orcp_process_subcription_form',
        email: email,
        nonce: nonce
      },
      success: function(response) {

        var parsedResponse = jQuery.parseJSON(response);

        if ( parsedResponse.status === 'success' ) {

          // Fade out and remove the form
          jQuery('#orcp-newsletter-subscribe').fadeOut();
          jQuery('#orcp-newsletter-subscribe').html('');
        }

        var checkoutNotice = '<section class="split-screen-container newsletter-notice-container">'
          + '<div class="split-screen-left newsletter-notice-left bg-binary"></div>'
          + '<div class="split-screen-right newsletter-notice-wrapper">'
            + '<div class="split-screen-body newsletter-notice">'
              + '<div class="split-screen-close newletter-notice-close">'
                  + '<a href="#" class="close-button"><img src="' + orcp.themeurl + '/assets/images/flex/close-button.svg" class="iconic" id="cart-error-close-img" width="36" height="36" alt="Close"></a>'
              + '</div>'
              + '<p>' + parsedResponse.message + '</p>'
            + '</div>'
          + '</div>'
        + '</section>';

        jQuery('body').append(checkoutNotice);

        var windowHeight = jQuery(window).height();

        jQuery('.newsletter-notice-container').css('height', windowHeight);
        jQuery('.newsletter-notice-wrapper').css('height', windowHeight);

        // Set the height of the pixels to the height of the facts box
        var boxHeight = jQuery('.newsletter-notice-container').height();
        jQuery('.newsletter-notice-left').height( boxHeight );

        // Toggle the facts box
        jQuery('.newsletter-notice-container').slideToggle();

        /* Close on close button click */
        jQuery('.newletter-notice-close a').click(function(e) {
          e.preventDefault();
          jQuery('.newsletter-notice-container').slideToggle();
        });

        /* Close on pixel grid click */
        jQuery('.newsletter-notice-left').click(function(e) {
          e.preventDefault();
          jQuery('.newsletter-notice-container').slideToggle();
        });

      }
    });

    return false;

  });

});


/**
 * Quantity Change in Mini Cart
 */
jQuery(window).load(function() {

  jQuery('.mini-cart-qty-trigger').click(function(e) {

    e.preventDefault();

    // Get the product ID
    var productID = jQuery(this).data('product-id');

    // Get the cart item key
    var cartItemKey = jQuery(this).data('itemkey');

    // Get the action
    var cartAction = jQuery(this).data('action');

    // Get the current quantity
    var currentQuantity = jQuery(this).parents('.mini-cart-qty').find('.mini-cart-qty-number').html();

    // Get on with the AJAX request
    jQuery.ajax({
      type: 'POST',
      url: orcp.ajaxurl,
      data: {
        'action': 'orcp_change_cart_qty',
        cartItemKey: cartItemKey,
        cartAction: cartAction,
        currentQuantity: currentQuantity,
        productID: productID,
      },
      success: function(response) {

        location.reload();

      }
    });

    return false;

  });

});

/**
 * Project Nav Position
 */
jQuery(window).load(function() {
  updateProjectNavPos();
});

// jQuery(window).resize(function() {
//   updateProjectNavPos();
// });

/**
 * Custom Text on Logo Click
 */
jQuery(window).load(function() {

  jQuery('.footer-details-logo img').click(function(e) {
    e.preventDefault();

    var customText = '<section class="split-screen-container custom-text-container">'
      + '<div class="split-screen-left custom-text-left bg-binary"></div>'
      + '<div class="split-screen-right custom-text-wrapper">'
        + '<div class="split-screen-body custom-text">'
          + '<div class="split-screen-close custom-text-close">'
              + '<a href="#" class="close-button"><img src="' + orcp.themeurl + '/assets/images/flex/close-button.svg" class="iconic" id="cart-error-close-img" width="36" height="36" alt="Close"></a>'
          + '</div>'
          + '<p>' + orcp.customText + '</p>'
        + '</div>'
      + '</div>'
    + '</section>';

    jQuery('body').append(customText);

    var windowHeight = jQuery(window).height();

    jQuery('.custom-text-container').css('height', windowHeight);
    jQuery('.custom-text-wrapper').css('height', windowHeight);

    // Set the height of the pixels to the height of the facts box
    var boxHeight = jQuery('.custom-text-container').height();
    jQuery('.custom-text-left').height( boxHeight );

    // Toggle the facts box
    jQuery('.custom-text-container').slideToggle();

    /* Close on close button click */
    jQuery('.custom-text-close a').click(function(e) {
      e.preventDefault();
      jQuery('.custom-text-container').slideToggle();
    });

    /* Close on pixel grid click */
    jQuery('.custom-text-left').click(function(e) {
      e.preventDefault();
      jQuery('.custom-text-container').slideToggle();
    });
  });

    jQuery('.product-item, .post-406, .product, .type-product, .status-publish, .has-post-thumbnail, .product_cat-shoes, .pa_color-black, .pa_color-blue, .pa_color-grey, .pa_color-white, .orcp_projects-project-1, .taxable, .shipping-taxable, .purchasable, .product-type-variable, .product-cat-shoes, .outofstock, .fp-section active').css('padding-top', '0px');
    // jQuery('.section, .fp-section, .fp-table, .active').css('padding-top', '100px');

});
